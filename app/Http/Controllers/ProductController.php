<?php

namespace App\Http\Controllers;

use App\Services\VersionService\IVersionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\ProductService\IProductService;
use App\Services\ModelService\IModelService;
use App\Services\BrandService\IBrandService;
use App\Services\UploadService\IUploadService;
use App\Services\AttachmentService\IAttachmentService;

class ProductController extends Controller
{
	private $productService;
	private $modelService;
    private $versionService;
	private $brandService;
	private $uploadService;
	private $attachService;

	/**
	 * undocumented function
	 *
	 * @return void
	 */
	public function __construct(IProductService $productService, IModelService $modelService, IVersionService $versionService, IBrandService $brandService, IUploadService $uploadService, IAttachmentService $attachmentService)
	{
		$this->middleware('auth');
		$this->productService = $productService;
		$this->modelService = $modelService;
		$this->brandService = $brandService;
		$this->uploadService = $uploadService;
		$this->attachService = $attachmentService;
        $this->versionService = $versionService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
		return view('products.index', [
			'products' => $this->productService->paginate(10)
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
		return view('products.create', [
			'models' => $this->modelService->all(),
			'brands' => $this->brandService->all(),
            'versions' => $this->versionService->all(),
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
        //dd($request->all());
		$productData = $request->except('files');
		$attachs = array();
		$storedAttachs = array();
		if ($request->hasFile('files')) {
			Log::info("Si hay archivos");
			foreach($request->file('files') as $file){
				$attachs = $this->uploadService->upload($file, 'products');
				$attachData['name'] = $attachs['fileName'];
				$attachData['folder'] = 'products';
				$attachData['mime'] = $file->getClientMimeType();
				$attachData['url'] = $attachs['fileDir'];
				$stored = $this->attachService->create($attachData);
				if ($stored)
					$storedAttachs[] = $stored->id;
				else
					break;
			}
		}
		Log::info("Se guardaron estos archivos");
		Log::info($storedAttachs);
		if ($product = $this->productService->create($productData)) {
			Log::info('Se guardo el producto');
			Log::info($product->id);
			$product->attachments()->sync($storedAttachs);
            return redirect()->route('products.index')->with(['message' => __('message.success_register')]);
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
        return view('products.show', [
            'product' => $this->productService->get($id)
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
        return view('products.edit', [
            'models' => $this->modelService->all(),
            'brands' => $this->brandService->all(),
            'versions' => $this->versionService->all(),
            'product' => $this->productService->get($id)
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

        $productData = $request->except('files');
        $attachs = array();
        $storedAttachs = array();
        if ($request->hasFile('files')) {
            Log::info("Si hay archivos");
            foreach($request->file('files') as $file){
                $attachs = $this->uploadService->upload($file, 'products');
                $attachData['name'] = $attachs['fileName'];
                $attachData['folder'] = 'products';
                $attachData['mime'] = $file->getClientMimeType();
                $attachData['url'] = $attachs['fileDir'];
                $stored = $this->attachService->create($attachData);
                if ($stored)
                    $storedAttachs[] = $stored->id;
                else
                    break;
            }
        }
        if ($productData["sold"]==0) {
            $productData["sold"] = null;            
        }
        //dd($productData);
        Log::info("Se guardaron estos archivos");
        Log::info($storedAttachs);

        if ($product = $this->productService->update($productData, $id)) {
            Log::info('Se actualizó el producto');
            Log::info($product->id);
            if (count($storedAttachs) > 0)
                $product->attachments()->sync($storedAttachs);

            return redirect()->route('products.index')->with(['message' => __('message.success_update')]);
        }

        return back()->withErrors(['message' => __('message.fail_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->productService->delete($id)){
            return redirect()->route('products.index')->with(['message' => __('message.success_delete')]);
        }
        return back()->withErrors(['message' => __('message.fail_delete')]);
    }

    public function getImages($id)
    {
        $product = $this->productService->get($id);

        return response()->json(array('status' => true, 'images' => $product->attachments()->get()));
    }
    /**
     * Set as Sold the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setSold(Request $request, $id)
    {

        Log::info("Moto vendida");
        Log::info($id);

        if ($product = $this->productService->sold($id)) {
            Log::info('Se actualizó el estatus de venta del producto');
            Log::info($product->id);

            return redirect()->route('products.index')->with(['message' => __('message.success_update')]);
        }

        return back()->withErrors(['message' => __('message.fail_update')]);
    }
}
