<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Model;
use Illuminate\Http\Request;
use App\Services\ModelService\IModelService;
use Illuminate\Support\Facades\Log;

class ModelController extends Controller
{
	private $modelService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IModelService $modelService)
	{
		$this->modelService = $modelService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return response()->json($this->modelService->all());
    }

	public function getByBrand($year, $brand_id)
	{
		return response()->json($this->modelService->byBrand($year, $brand_id));
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

    public function versions($id, $year)
    {
        $model = Model::find($id);
        //convertimos esta linea en sql $model->version()->where('year', $year)->get();
        $query = $model->version()->where('year', $year);
        $sql = $query->toSql();
        Log::info($sql);
        return $model->version()->where('year', $year)->get();
    }
}
