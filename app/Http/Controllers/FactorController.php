<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FactorService\IFactorService;
use App\Services\KMService\IKMService;
use App\Services\MotorService\IMotorService;
use App\Imports\MarketLaunchImport;
use Maatwebsite\Excel\Facades\Excel;

class FactorController extends Controller
{
	private $factorService;
	private $kmService;
	private $motorService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IFactorService $factorService, IKMService $kmService, IMotorService $motorService)
	{
		$this->middleware('auth');
		$this->factorService = $factorService;
		$this->kmService = $kmService;
		$this->motorService = $motorService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('factors.index', [
			'factors' => $this->factorService->paginate(10)
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('factors.create', [
			'kms' => $this->kmService->all(),
			'motors' => $this->motorService->all(),
		]);
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

		if ($this->factorService->create($data)){
            return redirect()->route('factors.index')->with(['message' => __('message.success_register')]);
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
		return view('factors.show', [
			'factor' => $this->factorService->get($id)
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
		return view('factors.edit', [
			'factor' => $this->factorService->get($id),
			'kms' => $this->kmService->all(),
			'motors' => $this->motorService->all(),
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

		if ($this->factorService->update($data, $id)){
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

	/**
     * Import the specified resource in storage on a bulk operation.
	 *
	 * @return void
	 */
	public function bulkImport()
	{
		return view('factors.bulk');
	}

	/**
	 * Import all of the sheet
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
	public function bulkImporter(Request $request)
	{
		if ($request->hasFile('factor_file')) {
			$import = new MarketLaunchImport();
			$import->onlySheets('FACTOR KM');
			Excel::import($import, $request->file('factor_file'));
		}
		return view('marketLaunchs.bulk');
	}
}
