<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentsExport;
use App\Http\Requests\NewAppointment;
use App\Http\Requests\ReportRequest;
use App\Services\AppointmentService\IAppointmentService;
use App\Services\CustomerService\ICustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class AppointmentController extends Controller
{
    private $appointmentService;
    private $customerService;

    public function __construct(IAppointmentService $appointmentService, ICustomerService $customerService)
    {
        $this->middleware('auth');
        $this->appointmentService = $appointmentService;
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointments.index', [
            'appointments' => $this->appointmentService->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewAppointment $request)
    {
        $customerData = $request->except(['day', 'hour', 'terms_check', 'privacy_check']);
        $appointmentData = $request->only(['day', 'hour']);
        $customerData['password'] = md5(rand());
        //Se procede a procesar al usuario
        if ($existingCustomer = $this->customerService->getByEmail($request->get('email'))) {
            // Si ya existe se asigna a la variable customer
            $customer = $existingCustomer;
        }else{
            // Si no existe se crea y se asigna a la variable customer
            $customer = $this->customerService->create($customerData);
        }

        if ($customer){
            $appointmentData['customer_id'] = $customer->id;

            if ($appointment = $this->appointmentService->create($appointmentData)){
                $appointment->products()->attach($request->get('product_id'));
                return back()->with(['message' => __('appointment.success_register')]);
            }
            return back()->withErrors(['message' => __('appointment.fail_register')]);
        }

        return back()->withErrors(['message' => __('appointment.fail_register')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('appointments.show', [
            'appointment' => $this->appointmentService->get($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    public function report(ReportRequest $request)
    {
        return Excel::download(new AppointmentsExport($request->get('start_date'), $request->get('end_date')), "Reporte_de_citas.xlsx");
    }

    public function search(ReportRequest $request)
    {
        return view('appointments.index', [
            'appointments' => $this->appointmentService->searchByDate($request->get('start_date'), $request->get('end_date')),
        ]);
    }

    public function indexForProducts()
    {
        return view('appointments.indexProducts', [
            'appointments' => $this->appointmentService->getForProducts()
        ]);
    }

    public function indexForQuotations()
    {
        return view('appointments.indexQuotations', [
            'appointments' => $this->appointmentService->getForQuotations()
        ]);
    }
}
