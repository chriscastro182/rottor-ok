<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\AttachmentService\IAttachmentService;
use App\Services\UploadService\IUploadService;
use Illuminate\Http\Request;
use App\Services\BrandService\IBrandService;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
	private $brandService;
    private $uploadService;
    private $attachService;

	/**
	 * Constructor function
	 *
	 * @return void
	 */
	public function __construct(IBrandService $brandService, IUploadService $uploadService, IAttachmentService $attachmentService)
	{
		$this->middleware('auth');
		$this->brandService = $brandService;
        $this->uploadService = $uploadService;
        $this->attachService = $attachmentService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
		return view('brands.index', [
			'brands' => $this->brandService->paginate(10)
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
		return view('brands.create');
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
        $storedAttachs = array();
        if ($request->hasFile('file')) {
            Log::info("Si hay archivos");
            $file = $request->file('file');
            $attachs = $this->uploadService->upload($file, 'brands');
            $attachData['name'] = $attachs['fileName'];
            $attachData['folder'] = 'brands';
            $attachData['mime'] = $file->getClientMimeType();
            $attachData['url'] = $attachs['fileDir'];
            $stored = $this->attachService->create($attachData);
            if ($stored)
                $storedAttachs[] = $stored->id;
        }
        Log::info("Se guardaron estos archivos");
        Log::info($storedAttachs);

		if ($brand = $this->brandService->create($data)){
            Log::info('Se guardo la marca');
            Log::info($brand->id);
            $brand->attachments()->sync($storedAttachs);
            return redirect()->route('brands.index')->with(['message' => __('message.success_register')]);
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
		return view('brands.show', [
			'brand' => $this->brandService->get($id)
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
		return view('brands.edit', [
			'brand' => $this->brandService->get($id)
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
        $storedAttachs = array();
        if ($request->hasFile('file')) {
            Log::info("Si hay archivos");
            $file = $request->file('file');
            $attachs = $this->uploadService->upload($file, 'brands');
            $attachData['name'] = $attachs['fileName'];
            $attachData['folder'] = 'brands';
            $attachData['mime'] = $file->getClientMimeType();
            $attachData['url'] = $attachs['fileDir'];
            $stored = $this->attachService->create($attachData);
            if ($stored)
                $storedAttachs[] = $stored->id;
        }

		if ($brand = $this->brandService->update($data, $id)){
            $brand->attachments()->sync($storedAttachs);
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

    public function getAllForSelect()
    {
        return response()->json($this->brandService->all());
    }

    public function getModelsForBrand($brand_id)
    {
        return response()->json($this->brandService->getBrands($brand_id));
    }
}
