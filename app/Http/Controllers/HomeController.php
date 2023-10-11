<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CustomerContact;
use App\Services\CustomerService\CustomerService;
use App\Services\MessageService\MessageService;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->only('home');
	}

	public function index()
	{
		return view('home');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 */
	public function home()
	{
		return view('welcome');
	}
	

	/**
	 * Ruta para prueba de rutas
	 *
	 * @return void
	 */
	public function test()
	{
		return "Prueba";
	}

    public function privacy()
    {
        return view('privacy');
    }
	

	/**
	 * Function to store the user from the contact form 
	 *
	 * @return Response
	 */
	public function contact(Request $request)
	{
		//Se obtienen los datos del cliente
		$customerData = $request->except(['subject', 'message', '_token']);
		//Se obtienen los datos del mensaje
		$messageData['subject'] = "Cotización";
		$messageData['message'] = $request->get('message');
		// Se setea un password random por la necesidad de la BD
		$customerData['password'] = md5(rand());

		//Se llaman a los servicios
		$customerService = new CustomerService();
		$messageService = new MessageService();

		//Se verifica si el usuario ya existe en la BD
		if ($existingCustomer = $customerService->getByEmail($customerData['email'])) {
			// Si ya existe se procede a registrar el mensaje	
			$messageData['customer_id'] = $existingCustomer->id;	
			if ($message = $messageService->create($messageData)) {
				//Si se registro el mensaje correctamente
				
				//Se manda correo
				Mail::to('contacto@rottor.mx')->send(new CustomerContact($existingCustomer, $message));

				//Se regresa la respuesta correcta
				return back()->with(['message' => __('labels.success_register'), 'customer' => $existingCustomer, 'register' => $message]);	
			}
			// En caso contrario
			return back()->withErrors(['message' => __('labels.fail_message')]);
		}else{// Si no existe en la BD
			if ($customer = $customerService->create($customerData)) {
				// Si se creo correctamente el cliente se procede a registarr el mensaje
				$messageData['customer_id'] = $customer->id;	
				if ($message = $messageService->create($messageData)) {
					//Si se registro el mensaje correctamente
					
					//Se manda correo
					Mail::to('contacto@rottor.mx')->send(new CustomerContact($customer, $message));

					// Se regresa la respuesta correcta
					return back()->with(['message' => __('labels.success_register'), 'customer' => $customer, 'register' => $message]);	
				}
				// En caso contrario
				return back()->withErrors(['message' => __('labels.fail_message')]);
			}
		}

		// Si todo lo anterior falla
		return back()->withErrors(['message' => __('labels.fail_register')]);
	}
	
}

