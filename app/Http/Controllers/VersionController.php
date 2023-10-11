<?php

namespace App\Http\Controllers;

use App\Services\ModelService\IModelService;
use App\Services\VersionService\IVersionService;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    private $service;
    private $modelService;

    public function __construct(IVersionService $versionService, IModelService $modelService)
    {
        $this->middleware('auth');
        $this->service = $versionService;
        $this->modelService = $modelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('versions.index', [
            'versions' => $this->service->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('versions.create', [
            'models' => $this->modelService->all(),
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
        if ($this->service->create($data)){
            return redirect()->route('versions.index')->with(['message' => __('message.success_register')]);
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
        return view('versions.show', [
            'version' => $this->service->get($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('versions.edit', [
            'version' => $this->service->get($id),
            'models' => $this->modelService->all()
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
        if ($this->service->update($data, $id)){
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
