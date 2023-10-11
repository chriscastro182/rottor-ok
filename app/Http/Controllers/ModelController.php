<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ModelService\IModelService;
use App\Services\BrandService\IBrandService;

class ModelController extends Controller
{

	private $modelService;
	private $brandService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IModelService $modelService, IBrandService $brandService)
	{
		$this->middleware('auth');
		$this->modelService = $modelService;
		$this->brandService = $brandService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
		return view('models.index', [
			'models' => $this->modelService->all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
		return view('models.create', [
			'brands' => $this->brandService->all()
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
		$data = $request->all();

		if ($this->modelService->create($data)){
            return redirect()->route('models.index')->with(['message' => __('message.success_register')]);
        }

        return back()->withErrors(['message' => __('message.fail_register')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
		return view('models.show', [
			'model' => $this->modelService->get($id)
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
		return view('models.edit', [
			'model' => $this->modelService->get($id),
			'brands' => $this->brandService->all()
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
		$data = $request->all();

		if ($this->modelService->update($data, $id)){
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

    public function getVersions($id)
    {
        return response()->json($this->modelService->getVersions($id));
    }
}
