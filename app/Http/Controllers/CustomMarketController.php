<?php

namespace App\Http\Controllers;

use App\Exports\CustomMarketsExport;
use App\Http\Requests\ReportRequest;
use App\Services\CustomMarketService\ICustomMarketService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomMarketController extends Controller
{
    private $customMarketService;

    public function __construct(ICustomMarketService $customMarketService)
    {
        $this->middleware('auth');
        $this->customMarketService = $customMarketService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('customMarkets.index',[
            'markets' => $this->customMarketService->paginate(10)
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('customMarkets.show',[
            'market' => $this->customMarketService->get($id)
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

    public function report(ReportRequest $request)
    {
        return Excel::download(new CustomMarketsExport($request->get('start_date'), $request->get('end_date')), 'Reporte_Cotizaciones.xlsx');
    }

    public function search(ReportRequest $request)
    {
        return view('customMarkets.search', [
            'markets' => $this->customMarketService->searchByDate($request->get('start_date'), $request->get('end_date'))
        ]);
    }
}
