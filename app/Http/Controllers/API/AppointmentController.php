<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService\IAppointmentService;
use App\Services\CustomerService\ICustomerService;
use App\Services\CustomMarketService\ICustomMarketService;
use App\Services\QuotationService\IQuotationService;
use App\Services\ProductService\IProductService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoDeCotizacion;
use App\Model\Product;

class AppointmentController extends Controller
{
    private $appointmentService;
    private $customMarketService;
    private $customerService;
    private $quotationService;

    public function __construct(IAppointmentService $appointmentService, ICustomMarketService $customMarketService, ICustomerService $customerService, IQuotationService $quotationService, IProductService $productService)
    {
        $this->appointmentService = $appointmentService;
        $this->customMarketService = $customMarketService;
        $this->customerService = $customerService;
        $this->quotationService = $quotationService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $customerData = $request->get('user');
        $customerData['password'] = md5(rand());
        $market = $request->get('market');
        $customerSelection = $request->get('customer');
        $customerSelection2 = $request->get('customer2');
        $appointmentData = $request->get('appointment');
        $subject = "Agendar cita";
        //unimos en un array los datos customer y appointment
        $mensajeOriginal = array();
        
        if (gettype($customerData) == "array") {
            //Unimos con mensajeOriginal
            $mensajeOriginal = array_merge($mensajeOriginal,$customerData);
        }
        if (gettype($market) == "array") {
            //Unimos con mensajeOriginal
            $mensajeOriginal = array_merge($mensajeOriginal,$market);
        }
        if (gettype($appointmentData) == "array") {
            //Unimos con mensajeOriginal
            $mensajeOriginal = array_merge($mensajeOriginal,$appointmentData);
        }
        if (gettype($customerSelection2) == "array") {
            //Unimos con mensajeOriginal
            $mensajeOriginal = array_merge($mensajeOriginal,$customerSelection2);
        }
        $mensaje = [];
        // traducimos lo que tiene el array en otro string year  brand  model  version  km  cc  name  lastname  email  phone
        foreach ($mensajeOriginal as $key => $value) {
            if ($key == 'name') {
                $mensaje['nombre'] = $value;
            }
            elseif ($key == 'lastname') {
                $mensaje['apellido'] = $value;
            }
            elseif ($key == 'email') {
                $mensaje['correo'] = $value;
            }
            elseif ($key == 'phone') {
                $mensaje['telefono'] = $value;
            }
            elseif ($key == 'brand') {
                $mensaje['marca'] = $value;
            }
            elseif ($key == 'model') {
                $mensaje['modelo'] = $value;
            }
            //version
            elseif ($key == 'version') {
                $mensaje['version'] = $value;
            }
            //year
            elseif ($key == 'year') {
                $mensaje['año'] = $value;
            }
            //km
            elseif ($key == 'km') {
                $mensaje['kilometraje'] = $value;
            }
            //dia
            elseif ($key == 'day') {
                $mensaje['dia'] = $value;
            }
            //hora 
            elseif ($key == 'hour') {
                $mensaje['hora'] = $value;
            }

        }


        //Se procede a procesar al usuario
        if ($existingCustomer = $this->customerService->getByEmail($customerData['email'])) {
            // Si ya existe se asigna a la variable customer
            $customer = $existingCustomer;
        }else{
            // Si no existe se crea y se asigna a la variable customer
            $customer = $this->customerService->create($customerData);
        }

        if ($customer){
            $quotationData['market_launch_id'] = $market['id'];
            $quotationData['km'] = $customerSelection['km'];
            $quotationData['import'] = $market['full_payment'];
            $quotationData['discount_factor'] = 0.00;
            $quotationData['total'] = $market['full_payment'];
            $quotationData['is_cash'] = true;
            // Si ya trae una pre cotizacion
            if ($market['quote_id']){
                $appointmentData['customer_id'] = $customer->id;
                if ($appointment = $this->appointmentService->create($appointmentData)){
                    $appointment->quotations()->sync([$market['quote_id']]);
                    Mail::to('contacto@rottor.mx')->send(new CorreoDeCotizacion($subject,$mensaje));
                    return response()->json(array('state' => true, 'message' => "Se registro la cita correctamente", 'appointment' => $appointment));
                }else{
                    return response()->json(array('state' => false, 'message' => "No se pudo registrar la cita"));
                }
            } elseif ($quotation = $this->quotationService->create($quotationData)){// Si no trae una pre cotizacion se crea una
                $appointmentData['customer_id'] = $customer->id;
                if ($appointment = $this->appointmentService->create($appointmentData)){
                    $appointment->quotations()->sync([$quotation->id]);
                    Mail::to('contacto@rottor.mx')->send(new CorreoDeCotizacion($subject,$mensaje));
                    return response()->json(array('state' => true, 'message' => "Se registro la cita correctamente", 'appointment' => $appointment));
                }else{
                    return response()->json(array('state' => false, 'message' => "No se pudo registrar la cita"));
                }
            }else{
                return response()->json(array('state' => false, 'message' => "No se pudo registrar la info de la moto"));
            }
        }
        return response()->json(array('state' => false, 'message' => "No se pudo registrar al cliente"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function product(Request $request)
    {
        Log::info("Guardando la cita de compra de producto");
        /*$validator = Validator::make($request->all(),[
            'product_id' => 'required',
            'user.name' => 'required',
            'user.lastname' => 'required|integer',
            'user.email' => 'required',
            'user.phone' => 'required',
            'user.cellphone' => 'required',
            'appointment.day' => 'required|date',
            'appointment.hour' => 'required',
            'privacy_check' => 'accepted',
            'terms_check' => 'accepted',
        ],[
            'product_id.required' => "No hay producto seleccionado",
            'user.name.required' => "El nombre es obligatorio",
            'user.lastname.required' => "El apellido es obligatorio",
            'user.email.required' => "El correo es obligatorio",
            'user.phone.required' => "El teléfono es obligatorio",
            'user.cellphone.required' => "El teléfono celular es obligatorio",
            'appointment.day.required' => "La fecha de la cita es obligatoria",
            'appointment.hour.required' => "La hora de la cita es obligatoria",
            'terms_check.accepted' => "Se deben de aceptar los Términos y Condiciones",
            'privacy_check.accepted' => "Se debe de aceptar la Política de Privacidad",
        ]);

        if ($validator->fails()){
            return response()->json(array('status' => false, 'message' => $validator));
        }*/

        $customerData = $request->get('user');
        $customerData['password'] = md5(rand());
        Log::info("Data del cliente");
        Log::info($customerData);
        //Se procede a procesar al usuario
        if ($existingCustomer = $this->customerService->getByEmail($customerData['email'])) {
            // Si ya existe se asigna a la variable customer
            $customer = $existingCustomer;
        }else{
            // Si no existe se crea y se asigna a la variable customer
            $customer = $this->customerService->create($customerData);
        }

        if ($customer){
            Log::info('Si hay cliente');

            $product = $this->productService->get($request->get('product_id'));
            
            $hubspotApiUrl = 'https://api.hubapi.com/crm/v3/objects/contacts';
            $accessToken = 'pat-na1-0498ad2e-ceb6-4bbc-a723-f3e95addf05a';

            if (!$product) {
                return response()->json(array('status' => false, 'message' => __('appointment.fail_register')));
            }

            $bikeString = $product->brand->name.'-'.$product->model->description.'-'.$product->version->name.'-'.$product->year.'-'.$product->km;

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($hubspotApiUrl, [
                'properties' => [
                    'firstname' => $customer->name,
                    'lastname' => $customer->lastname,
                    'email' => $customer->email,
                    'phone' => $customer->cellphone,
                    'tipo' => 'Comprar',
                    'datos_moto' => $bikeString,
                ],
            ]);

            // Obtén la respuesta de la API
            $responseBody = $response->body();
            
            // Verificar la respuesta
            if ($response->successful()) {
                return response()->json(array('status' => true, 'message' => __('appointment.success_register')));
            } else {
                Log::info('Error al registrar a Hubspot');
                Log::info($customer);
                return response()->json(array('status' => true, 'message' => __('appointment.fail_register')));
            }


            /* if ($appointment = $this->appointmentService->create($appointmentData)){
                Log::info("Se registro la cita. Se procede a asignar el producto a la cita");
                Log::info($request->get('product_id'));
                $appointment->products()->attach($request->get('product_id'));
                
                $subject = "Agendar cita";
                $mensaje = array_merge($customerData, $appointmentData);

                Mail::to('contacto@rottor.mx')->send(new CorreoDeCotizacion($subject,$mensaje));
                return response()->json(array('status' => true, 'message' => __('appointment.success_register'), 'appointment' => $appointment));
            } */
        } else {
            return response()->json(array('status' => false, 'message' => __('appointment.fail_register')));
        }

    }
}
