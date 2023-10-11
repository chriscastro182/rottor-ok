<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CustomerService\CustomerService;
use App\Services\MessageService\MessageService;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerContact;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validated = Validator::make($request->all(), [
			'name' => 'required',
			'lastname' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'message' => 'required'
		],[
			'name.required' => "El nombre es valor requerido",
			'lastname.required' => "El apellido es valor requerido",
			'email.required' => "El correo electrónico es valor requerido",
			'phone.required' => "El teléfono es valor requerido",
			'message.required' => "La información de la moto es requerida",
		]);

		if ($validated->fails()) {
			return response()->json(['status' => false, 'message' => $validated->errors()]);	
		}

		//Si pasa la validación
		//Se llaman a los servicios
		$customerService = new CustomerService();
		$messageService = new MessageService();
		
		//Se obtienen los datos del cliente
		$customerData = $request->except(['subject', 'message']);
		//Se obtienen los datos del mensaje
		$messageData['subject'] = $request->get('subject');
		$messageData['message'] = $request->get('message');
		// Se setea un password random por la necesidad de la BD
		$customerData['password'] = md5(rand());

		//Se verifica si el usuario ya existe en la BD
		if ($existingCustomer = $customerService->getByEmail($customerData['email'])) {
			// Si ya existe se procede a registrar el mensaje	
			$messageData['customer_id'] = $existingCustomer->id;	
			if ($message = $messageService->create($messageData)) {
				//Si se registro el mensaje correctamente
				
				//Se manda correo
				Mail::to('contacto@rottor.mx')->send(new CustomerContact($existingCustomer, $message));

				//Se regresa la respuesta correcta
				return response()->json(['status' => true, 'message' => __('labels.success_register'), 'customer' => $existingCustomer, 'register' => $message]);	
			}
			// En caso contrario
			return response()->json(['status' => false, 'message' => __('labels.fail_message')]);
		}else{// Si no existe en la BD
			if ($customer = $customerService->create($customerData)) {
				// Si se creo correctamente el cliente se procede a registarr el mensaje
				$messageData['customer_id'] = $customer->id;	
				if ($message = $messageService->create($messageData)) {
					//Si se registro el mensaje correctamente
					
					//Se manda correo
					Mail::to('contacto@rottor.mx')->send(new CustomerContact($customer, $message));

					// Se regresa la respuesta correcta
					return response()->json(['status' => true, 'message' => __('labels.success_register'), 'customer' => $customer, 'register' => $message]);	
				}
				// En caso contrario
				return response()->json(['status' => false, 'message' => __('labels.fail_message')]);
			}
		}
		
		return response()->json(['status' => false, 'message' => __('labels.fail_register')]);
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
}
