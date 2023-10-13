<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CustomerService\ICustomerService;
use App\Services\CustomMarketService\ICustomMarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoDeCotizacion;

class CustomMarketController extends Controller
{
    private $customMarketService;
    private $customerService;

    public function __construct(ICustomMarketService $customMarketService, ICustomerService $customerService)
    {
        $this->customMarketService = $customMarketService;
        $this->customerService = $customerService;
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
        $customData = $request->get('custom');

        if ($existingCustomer = $this->customerService->getByEmail($customerData['email'])) {
            // Si ya existe se asigna a la variable customer
            $customer = $existingCustomer;
        }else{
            // Si no existe se crea y se asigna a la variable customer
            $customer = $this->customerService->create($customerData);
        }

        //unimos customData con customerData
        $mensajeOriginal = array_merge($customData, $customerData);
        $mensaje = [];
        // traducimos lo que tiene el array en otro string year  brand  model  version  km  cc  name  lastname  email  phone 
        foreach ($mensajeOriginal as $key => $value) {
            if ($key == 'year') {
                $mensaje["año"] = $value;
            }
            elseif ($key == 'brand') {
                $mensaje["marca"] = $value;
            }
            elseif ($key == 'model') {
                $mensaje["modelo"] = $value;
            }
            elseif ($key == 'version') {
                $mensaje["version"] = $value;
            }
            elseif ($key == 'km') {
                $mensaje["kilometraje"] = $value;
            }
            elseif ($key == 'cc') {
                $mensaje["cilindraje"] = $value;
            }
            elseif ($key == 'name') {
                $mensaje["nombre"] = $value;
            }
            elseif ($key == 'lastname') {
                $mensaje["apellido"] = $value;
            }
            elseif ($key == 'email') {
                $mensaje["correo"] = $value;
            }
            elseif ($key == 'phone') {
                $mensaje["telefono"] = $value;
            }
            else {
                $mensaje[$key] = $value;
            }


        }
        $subject = "Cotización de moto";
        if ($customer){
            if ($customMarket = $customer->customMarkets()->create($customData)){
                Mail::to('deck_chris_182@hotmail.com')->send(new CorreoDeCotizacion($subject,$mensaje));//'Asunto del correo', 'Nombre del destinatario', 'Mensaje personalizado'
                return response()->json(array('state' => true, 'message' => "Se registraron los datos correctamente. En breve te mandaran cotización", 'custom' => $customMarket, 'customer' => $customer));
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

    public function getMostQuotesBikes()
    {
        Log::info("Obteniendo motocicletas mas cotizadas");
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportMostBikesQuotes()
        ]);
    }

    public function getLessQuotesBikes()
    {
        Log::info("Obteniendo motocicletas menos cotizadas");
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportLessBikesQuotes()
        ]);
    }

    public function getMostQuotesCC()
    {
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportMostCCQuotes()
        ]);
    }

    public function getLessQuotesCC()
    {
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportLessCCQuotes()
        ]);
    }

    public function getMostQuotesKM()
    {
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportMostKMQuotes()
        ]);
    }

    public function getLessQuotesKM()
    {
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportLessKMQuotes()
        ]);
    }

    public function getMostQuotesDate()
    {
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportMostDateQuotes()
        ]);
    }

    public function getLessQuotesDate()
    {
        return response()->json([
            'status' => true,
            'data' => $this->customMarketService->reportLessDateQuotes()
        ]);
    }
}
