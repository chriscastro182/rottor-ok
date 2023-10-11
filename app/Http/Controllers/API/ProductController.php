<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductImageCollection;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductResource;
use App\Services\ProductService\IProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(ProductResource::collection($this->productService->all()));
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

    public function getImages($id)
    {
        $product = $this->productService->get($id);

        return response()->json(array(
            'status' => true,
            'images' => ProductImageResource::collection($product->attachments()->orderBy('name', 'asc')->get())
        ));
    }

    public function filter(Request $request)
    {
        Log::info("Datos que pide el filtro");
        Log::info($request->all());

        return response()->json($this->productService->filter($request->all(), 10));
    }

    /**
     * Search.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function searchByWord(Request $request)
    {
        Log::info("Búsqueda tiempo real");
        Log::info($request->all());        

        return response()->json($this->productService->search($request->all(), 10));
    }
}
