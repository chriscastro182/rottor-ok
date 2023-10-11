<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KMService\IKMService;

class KmController extends Controller
{
	private $kmService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IKMService $kmService)
	{
		$this->middleware('auth');
		$this->kmService = $kmService;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('kms.index', [
			'kms' => $this->kmService->all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('kms.create');
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

		if ($this->kmService->create($data)){
            return redirect()->route('kms.index')->with(['message' => __('message.success_register')]);
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
		return view('kms.show', [
			'km' => $this->kmService->get($id)
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
		return view('kms.edit', [
			'km' => $this->kmService->get($id),
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

		if ($this->kmService->update($data, $id)){
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
