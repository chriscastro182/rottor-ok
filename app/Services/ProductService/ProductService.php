<?php

namespace App\Services\ProductService;

use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Product;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ProductService implements IBaseService, IProductService
{
	private $model;

	/**
	 * Function for create the resource through array of data
	 *
	 * @return Message|Boolean
	 */
	public function create(array $data)
	{
		try {
			DB::transaction(function() use($data){
				$this->model = Product::create($data);
			});

			return $this->model;
		} catch (QueryException $e) {
			Log::info($e->getMessage());
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}
		return false;
	}

	/**
	 * Function to update the resource
	 *
	 * @return void
	 */
	public function update(array $data, int $id)
	{
		try {
			DB::transaction(function() use($data, $id){
				$this->model = Product::find($id);
				$this->model->update($data);
			});

			return $this->model;
		} catch (QueryException $e) {
			Log::info($e->getMessage());
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}
		return false;
	}
	
	/**
	 * Function that deletes the resource
	 *
	 * @return boolean
	 */
	public function delete(int $id)
	{
		try {
			DB::transaction(function() use($id){
				$this->model = Product::find($id);
				$this->model->delete();
			});

			return true;	
		} catch (QueryException $e) {
			Log::info($e->getMessage());
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}
		return false;
	}

	/**
	 * Function that retrieves the resource
	 *
	 * @return Object
	 */
	public function get(int $id)
	{
		return Product::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Product::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Product::paginate($page);
	}

    public function getProductBrands()
    {
        return Brand::all();
    }

    public function filter(array $data, int $paginate)
    {
        Log::info("Datos para filtrar");
        Log::info($data);
        $query = Product::where('id', '>', 1);
        if ( isset($data['filters'][0]['brand_id']) && $data['filters'][0]['brand_id'] > 0 ){
            $query->where('brand_id', $data['filters'][0]['brand_id']);
        }
        if ( isset($data['filters'][0]['version_id']) && $data['filters'][0]['version_id'] > 0 ){
            $query->where('version_id', $data['filters'][0]['version_id']);
        }
        if ( isset($data['filters'][0]['model_id']) && $data['filters'][0]['model_id'] > 0 ){
            $query->where('model_id', $data['filters'][0]['version_id']);
        }
        return ProductResource::collection($query->get());
    }
}
