<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarketLaunchService\IMarketLaunchService;

class MarketLaunchController extends Controller
{
	private $marketService;

	/**
	 * undocumented function
	 *
	 * @return void
	 */
	public function __construct(IMarketLaunchService $marketService)
	{
		$this->marketService = $marketService;
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

	/**
	 * retrieves the data
	 *
     * @return \Illuminate\Http\Response
	 */
	public function getCotization(Request $request)
	{
		return response()->json($this->marketService->getCotization($request->all()));
	}

    public function getMostBrands()
    {
        return response()->json(array(
            'status' => true,
            'data' => $this->marketService->getMostBrandsQuote()
        ));
    }

    public function getLessBrands()
    {
        return response()->json(array(
            'status' => true,
            'data' => $this->marketService->getLessBrandsQuote()
        ));
    }
}
