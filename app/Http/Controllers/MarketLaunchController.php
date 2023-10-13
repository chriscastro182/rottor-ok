<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketLaunchService\IMarketLaunchService;
use App\Services\BrandService\IBrandService;
use App\Services\ModelService\IModelService;
use App\Imports\MarketLaunchImport;
use Maatwebsite\Excel\Facades\Excel;


class MarketLaunchController extends Controller
{
	private $marketLaunchService;
	private $brandService;
	private $modelService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IMarketLaunchService $marketLaunchService, IBrandService $brandService, IModelService $modelService)
	{
		$this->middleware('auth');
		$this->marketLaunchService = $marketLaunchService;
		$this->brandService = $brandService;
		$this->modelService = $modelService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('marketLaunchs.index', [
			'markets' => $this->marketLaunchService->paginate(10)
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('marketLaunchs.create',[
			'brands' => $this->brandService->all(),
			'models' => $this->modelService->all()
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

		if ($this->marketLaunchService->create($data)){
            return redirect()->route('marketLaunchs.index')->with(['message' => __('message.success_register')]);
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
		return view('marketLaunchs.show', [
			'marketLaunch' => $this->marketLaunchService->get($id)
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
		return view('marketLaunchs.edit', [
			'market' => $this->marketLaunchService->get($id),
			'brands' => $this->brandService->all(),
			'models' => $this->modelService->all()
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

		if ($this->marketLaunchService->update($data, $id)){
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
		return view('marketLaunchs.bulk');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 */
	public function bulkImporter(Request $request)
	{

		if ($request->hasFile('market_file')) {
      try {

        
        $import = new MarketLaunchImport();
        $import->onlySheets('ALGORITMO');
        Excel::import($import, $request->file('market_file'));
        
        return back()->with('success', 'Archivo Excel importado con éxito.');

      } catch (\Exception $e) {
          return back()->with('error', 'Error al importar el archivo Excel: ' . $e->getMessage());
      }
		} else {
      return back()->with('error', 'Archivo no seleccionado');
    }
	}

}
