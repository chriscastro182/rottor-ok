<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CustomerService\ICustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
	private $customerService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(ICustomerService $customerService)
	{
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
        $data = $request->all();
        $data['password'] = md5($data['password']);

        if ($customerLoggedIn = $this->customerService->create($data)){
            $token = $customerLoggedIn->createToken('rottor_token');
            return response()->json([
                'status' => true,
                'message' => "Se registro al usuario",
                'user_id' => $customerLoggedIn->id,
                'token' => $token->plainTextToken
            ]);
        }

        return response()->json(array(
            'status' => false,
            'message' => "No se pudo registrar al cliente",
            'data' => $request->all()
        ));
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

	/**
	 * Function to login the customer
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function login(Request $request)
	{
		$customerLoggedIn = $this->customerService->login($request->get('email'), $request->get('password'));

		if ($customerLoggedIn) {
			$token = $customerLoggedIn->createToken('rottor_token');	

			return response()->json([
				'status' => true,
				'message' => "Se logeo al usuario",
				'user_id' => $customerLoggedIn->id,
				'token' => $token->plainTextToken
			]);
		}

		return response()->json(array(
			'status' => false,
			'message' => "No se pudo autenticar al cliente",
			'data' => $request->all()
		));
	}
	
}
