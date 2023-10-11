<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\QuotationService\IQuotationService;
use Illuminate\Http\Request;

class QuotationController extends Controller
{

    private $service;

    public function __construct(IQuotationService $quotationService)
    {
        $this->service = $quotationService;
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

    public function getMostBrands()
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->getMostBrands()
        ]);
    }

    public function getLessBrands()
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->getLessBrands()
        ]);
    }

    public function getMostVersions()
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->getMostVersions()
        ]);
    }

    public function getLessVersions()
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->getLessVersions()
        ]);
    }

    public function getMostCC()
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->getMostCC()
        ]);
    }

    public function getLessCC()
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->getLessCC()
        ]);
    }
}
