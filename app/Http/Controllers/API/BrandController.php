<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\BrandService\IBrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
	private $brandService;

	/**
	 * Constructor fucntion
	 *
	 * @return void
	 */
	public function __construct(IBrandService $brandService)
	{
		$this->brandService = $brandService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($year)
    {
        //imprimimos en consola la fecha que nos enviaron
        // Log::info($fecha);
        Log::info('Llego aqui');
        
        //imprimimos en consola la fecha que nos enviaron
		return response()->json($this->brandService->allFecha($year));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
