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
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Appointment;

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
        
        $action = 'Vender';
        $customerData = $request->get('user');
        $customerData['password'] = md5(rand());
        $market = $request->get('market');
        $customerSelection = $request->get('customer');
        $customerSelection2 = $request->get('customer2');
        $appointmentData = $request->get('appointment');
        $subject = "Agendar cita";
        Log::info("Request completo de la cita");
        Log::info($request);
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
            $appointmentData = new Appointment();

            $appointmentData->day = date('Y-m-d');
            $appointmentData->hour = '00:00:00';

            // Registro de customer en CRM
            $hubspotApiUrl = 'https://api.hubapi.com/crm/v3/objects/contacts';
            $accessToken = 'pat-na1-0498ad2e-ceb6-4bbc-a723-f3e95addf05a';
            
            $customerSelection2['brand'];

            $bikeString = $appointmentData->day.'-'.$action.'-'.$customerSelection2['brand'].'-'.
                            $customerSelection2['model'].'-'.$customerSelection2['year'].'-'.
                            $customerSelection2['km'].'km - $'.$market['full_payment'].'- $'.
                            $market['exchange_payment'].'- $'.$market['allocation_payment'];



            if ($market['quote_id']){

                $appointmentData->customer_id = $customer->id;

                if ($appointment = $appointmentData->save()){
                    Log::info("Se registro la cita. Se procede a asignar la cotización a la cita");
                    Log::info($appointmentData->id);
                    $appointmentSaved = $this->appointmentService->get($appointmentData->id);

                    $appointmentSaved->quotations()->sync([$market['quote_id']]);

                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                    ])->post($hubspotApiUrl, [
                        'properties' => [
                            'firstname' => $customer->name,
                            'lastname' => $customer->lastname,
                            'email' => $customer->email,
                            'phone' => $customer->cellphone,
                            'tipo' => $action,
                            'datos_moto' => $bikeString,
                        ],
                    ]);

                    // Obtén la respuesta de la API
                    $responseBody = $response->body();

                    // Si registra usuario nuevo: IF, Si el usuario ya existe: ELSE
                    if ($response->successful()) {
                        Log::info('Response');
                        Log::info($response->json());
                        $hubspotCustomer =$response->json();
                        $customer->hubspot_id = $hubspotCustomer['id'];
                        // $this->customerService->update($customer, $customer->id);
                        $customer->save();
                        return response()->json(array('state' => true, 'message' => __('appointment.success_register')));
                    } else {
                        Log::info('Error al registrar a Hubspot');
                        Log::info($response->json());
                        $hubspotApiUrl = 'https://api.hubapi.com/crm/v3/objects/contacts/'.$customer->hubspot_id.'?properties=datos_moto';
                        
                        $response2 = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $accessToken,
                            ])->get($hubspotApiUrl);
                            
                        Log::info('ResponseBody2');
                        $responseBody2 = $response2->body(); 
                        Log::info($responseBody2);

                            
                        if ($response2->successful()) {
                            // Obtén la respuesta de la API
                            Log::info('Response encontro usuario Hubspot');
                            Log::info($response2->json());
                            
                            $responseCustomer = $response2->json();
                            $datosMoto = $responseCustomer['properties']['datos_moto'];
                            $datosMoto = $datosMoto.PHP_EOL.$bikeString;
                            Log::info($datosMoto);
                            
                            $response3 = Http::withHeaders([
                                'Authorization' => 'Bearer ' . $accessToken,
                                'Content-Type' => 'application/json',
                            ])->patch($hubspotApiUrl, [
                                'properties' => [
                                    'datos_moto' => $datosMoto,
                                ],
                            ]);
                            $responseBody3 = $response3->body(); 

                            if ($response3->successful()) {
                                Log::info('Datos de moto actualizados en Hubspot');
                            } else {
                                Log::info('Error al actualizar datos de moto, en Hubspot');
                            }

                            
                        } else {
                            Log::info('No se encontró usuario en Hubspot '.$client->hubspot_id);
                            Log::info($response2->json());
                        }
                        return response()->json(array('state' => true, 'message' => __('appointment.success_register')));
                    }

                    return response()->json(array('state' => true, 'message' => "Se registro la cita correctamente", 'appointment' => $appointmentSaved));
                    // Mail::to('contacto@rottor.mx')->send(new CorreoDeCotizacion($subject,$mensaje));
                }else{
                    return response()->json(array('state' => false, 'message' => "No se pudo registrar la cita"));
                }
            } elseif ($quotation = $this->quotationService->create($quotationData)){// Si no trae una pre cotizacion se crea una
                
                $appointmentData->customer_id = $customer->id;
                
                if ($appointment = $appointmentData->save()){

                    $appointmentSaved = $this->appointmentService->get($appointmentData->id);

                    $appointmentSaved->quotations()->sync([$quotation->id]);
                    
                    Log::info('Appointment saved');
                    Log::info($appointmentSaved);
                    

                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                    ])->post($hubspotApiUrl, [
                        'properties' => [
                            'firstname' => $customer->name,
                            'lastname' => $customer->lastname,
                            'email' => $customer->email,
                            'phone' => $customer->cellphone,
                            'tipo' => $action,
                            'datos_moto' => $bikeString,
                        ],
                    ]);

        
                    // Obtén la respuesta de la API
                    $responseBody = $response->body();
                    
                    // Si registra usuario nuevo: IF, Si el usuario ya existe: ELSE
                    if ($response->successful()) {
                        Log::info('Response');
                        Log::info($response->json());
                        $hubspotCustomer =$response->json();
                        $customer->hubspot_id = $hubspotCustomer['id'];
                        // $this->customerService->update($customer, $customer->id);
                        $customer->save();
                        return response()->json(array('state' => true, 'message' => __('appointment.success_register')));
                    } else {
                        Log::info('Error al registrar a Hubspot');
                        Log::info($response->json());
                        $hubspotApiUrl = 'https://api.hubapi.com/crm/v3/objects/contacts/'.$customer->hubspot_id.'?properties=datos_moto';
                        
                        $response2 = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $accessToken,
                            ])->get($hubspotApiUrl);
                            
                        Log::info('ResponseBody2');
                        $responseBody2 = $response2->body(); 
                        Log::info($responseBody2);
        
                            
                        if ($response2->successful()) {
                            // Obtén la respuesta de la API
                            Log::info('Response encontro usuario Hubspot');
                            Log::info($response2->json());
                            
                            $responseCustomer = $response2->json();
                            $datosMoto = $responseCustomer['properties']['datos_moto'];
                            $datosMoto = $datosMoto.PHP_EOL.$bikeString;
                            Log::info($datosMoto);
                            
                            $response3 = Http::withHeaders([
                                'Authorization' => 'Bearer ' . $accessToken,
                                'Content-Type' => 'application/json',
                            ])->patch($hubspotApiUrl, [
                                'properties' => [
                                    'datos_moto' => $datosMoto,
                                ],
                            ]);
                            $responseBody3 = $response3->body(); 
        
                            if ($response3->successful()) {
                                Log::info('Datos de moto actualizados en Hubspot');
                            } else {
                                Log::info('Error al actualizar datos de moto, en Hubspot');
                            }
        
                            
                        } else {
                            Log::info('No se encontró usuario en Hubspot '.$client->hubspot_id);
                            Log::info($response2->json());
                        }
                        return response()->json(array('state'  => true, 'message' => __('appointment.success_register')));
                    }
            

                    // Mail::to('contacto@rottor.mx')->send(new CorreoDeCotizacion($subject,$mensaje));
                    //return response()->json(array('state' => true, 'message' => "Se registro la cita correctamente", 'appointment' => $appointment));
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
        $action = 'Comprar';
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

        $appointmentData = new Appointment();

        $appointmentData->day = date('Y-m-d');
        $appointmentData->hour = '00:00:00';
        
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
            
            if (!$product) {
                return response()->json(array('status' => false, 'message' => __('appointment.fail_register')));
            }
            $hubspotApiUrl = 'https://api.hubapi.com/crm/v3/objects/contacts';
            $accessToken = 'pat-na1-0498ad2e-ceb6-4bbc-a723-f3e95addf05a';


            $bikeString = $appointmentData->day.'-'.$action.'-'.$product->brand->name.'-'.$product->model->description.'-'.$product->version->name.'-'.$product->year.'-'.$product->km;

            $appointmentData->customer_id = $customer->id;
            if ($appointment = $appointmentData->save()){
                Log::info("Se registro la cita. Se procede a asignar el producto a la cita");
                Log::info($customer->id);
                $appointmentSaved = $this->appointmentService->get($appointmentData->id);
                $appointmentSaved->products()->attach($product->id);
                
                /* $subject = "Agendar cita";
                $mensaje = array_merge($customerData, $appointmentData);

                Mail::to('contacto@rottor.mx')->send(new CorreoDeCotizacion($subject,$mensaje)); */
                
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($hubspotApiUrl, [
                'properties' => [
                    'firstname' => $customer->name,
                    'lastname' => $customer->lastname,
                    'email' => $customer->email,
                    'phone' => $customer->cellphone,
                    'tipo' => $action,
                    'datos_moto' => $bikeString,
                ],
            ]);

            // Obtén la respuesta de la API
            $responseBody = $response->body();
            
            // Si registra usuario nuevo: IF, Si el usuario ya existe: ELSE
            if ($response->successful()) {
                Log::info('Response');
                Log::info($response->json());
                $hubspotCustomer =$response->json();
                $customer->hubspot_id = $hubspotCustomer['id'];
                // $this->customerService->update($customer, $customer->id);
                $customer->save();
                return response()->json(array('status' => true, 'message' => __('appointment.success_register')));
            } else {
                Log::info('Error al registrar a Hubspot');
                Log::info($response->json());
                $hubspotApiUrl = 'https://api.hubapi.com/crm/v3/objects/contacts/'.$customer->hubspot_id.'?properties=datos_moto';
                
                $response2 = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    ])->get($hubspotApiUrl);
                    
                Log::info('ResponseBody2');
                $responseBody2 = $response2->body(); 
                Log::info($responseBody2);

                    
                if ($response2->successful()) {
                    // Obtén la respuesta de la API
                    Log::info('Response encontro usuario Hubspot');
                    Log::info($response2->json());
                    
                    $responseCustomer = $response2->json();
                    $datosMoto = $responseCustomer['properties']['datos_moto'];
                    $datosMoto = $datosMoto.PHP_EOL.$bikeString;
                    Log::info($datosMoto);
                    
                    $response3 = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                    ])->patch($hubspotApiUrl, [
                        'properties' => [
                            'datos_moto' => $datosMoto,
                        ],
                    ]);
                    $responseBody3 = $response3->body(); 

                    if ($response3->successful()) {
                        Log::info('Datos de moto actualizados en Hubspot');
                    } else {
                        Log::info('Error al actualizar datos de moto, en Hubspot');
                    }

                    
                } else {
                    Log::info('No se encontró usuario en Hubspot '.$client->hubspot_id);
                    Log::info($response2->json());
                }
                return response()->json(array('status' => true, 'message' => __('appointment.success_register')));
            }



        } else {
            return response()->json(array('status' => false, 'message' => __('appointment.fail_register')));
        }

    }
}
