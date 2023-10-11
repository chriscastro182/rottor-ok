<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MotorService\IMotorService;

class MotorController extends Controller
{
	private $motorService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IMotorService $motorService)
	{
		$this->middleware('auth');
		$this->motorService = $motorService;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('motors.index', [
			'motors' => $this->motorService->all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('motors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->all();

		if ($this->motorService->create($data)){
            return redirect()->route('motors.index')->with(['message' => __('message.success_register')]);
        }

        return back()->withErrors(['message' => __('message.fail_register')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return view('motors.show', [
			'motor' => $this->motorService->get($id)
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
		return view('motors.edit', [
			'motor' => $this->motorService->get($id),
		]);
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
		$data = $request->all();

		if ($this->motorService->update($data, $id)){
            return back()->with(['message' => __('message.success_update')]);
        }

        return back()->withErrors(['message' => __('message.fail_update')]);
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
