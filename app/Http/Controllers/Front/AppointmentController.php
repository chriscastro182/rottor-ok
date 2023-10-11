<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService\IAppointmentService;
use App\Services\CartService\ICartService;
use App\Services\CustomerService\ICustomerService;
use App\Services\OrderService\IOrderService;
use App\Services\ProductService\IProductService;
use App\Services\UserService\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    private $appointmentService;
    private $customerService;
    private $cartService;
    private $orderService;
    private $productService;

    public function __construct(IAppointmentService $appointmentService, ICustomerService $customerService, ICartService $cartService, IOrderService $orderService, IProductService $productService)
    {
        $this->appointmentService = $appointmentService;
        $this->customerService = $customerService;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $cartData = array();
        $orderData = array();
        $customerData = $request->only(['name', 'lastname', 'email', 'phone', 'cellphone', 'birth_date']);
        $customerData['password'] = md5(rand());
        //dd($customerData);
        // Se busca al usuario si ya existe
        if ($existingCustomer = $this->customerService->getByEmail($customerData['email'])) {
            // Si ya existe se asigna a la variable customer
           $customer = $existingCustomer;
        }else{
            // Si no existe se crea y se asigna a la variable customer
            $customer = $this->customerService->create($customerData);
        }
        $product = $this->productService->get($request->get('product_id'));
        $cartData['cart_status_id'] = 1;
        $cartData['ip'] = $request->ip();
        $cartData['user_agent'] = $request->header('user-agent');
        $cartData['import'] = $product->price;
        $cartData['iva'] = 00.00;
        $cartData['total'] = $product->price;

        // Obtenemos el carrito
        $cart = $this->cartService->create($cartData);
        // Validamos si se crearon el cliente y el carrito
        if ($customer && $cart){
            $orderData['order_status_id'] = 1;
            $orderData['customer_id'] = $customer->id;
            $orderData['cart_id'] = $cart->id;
            $orderData['import'] = $cart->import;
            $orderData['iva'] = $cart->iva;
            $orderData['total'] = $cart->total;
            $orderData['code'] = 'N/A';
            Log::info("Orden a insertar");
            Log::info($orderData);
            // Se crea la orden
            if($order = $this->orderService->create($orderData)){
                // Se procede a crear la cita
                $appointmentData = array();
                $appointmentData['customer_id'] = $customer->id;
                $appointmentData['day'] = $request->get('appointment_date');
                $appointmentData['hour'] = $request->get('appointment_hour');
                // Se procede a crear la cita
                if ($appointment = $this->appointmentService->create($appointmentData)){
                    // Si se creo la cita correctamente se procede a asignar la data ya creada
                    $appointment->orders()->sync([$order->id]);
                    return back()->with(['message' => __('appointment.success_register'), 'appointment' => $appointment]);
                }else{
                    return back()->withErrors(['message' => __('appointment.fail_register')]);
                }
            }else{
                return back()->withErrors(['message' => __('order.fail_register')]);
            }
        }
        return back()->withErrors(['message' => __('labels.fail_register')]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
