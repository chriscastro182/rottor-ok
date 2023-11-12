<?php

namespace App\Services\ProductService;

use App\Http\Resources\ProductResource;
use Illuminate\Database\Query\Builder; 
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
				if (!$data['apartada']) {
					$data['apartada'] = null;
				}			
				$this->model->update($data);
				// dd($this->model);
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
		return Product::all()->sortBy([
			['priority', 'asc']
		]);
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
		$request = $data['filters'][0];

        Log::info("Datos para filtrar");
        Log::info($request);
		$models = $request['model_id'];
		$brands = $request['brand_id'];
		$versions = $request['version_id'];
		$year = $request['year'];
		$minKM =$request['minKmRange'] ?? 0;
		$maxKM = $request['maxKmRange'] ?? 99999999;
		$kms = [$minKM, $maxKM];
		$minPrice = $request['minPriceRange'] ?? 0;
		$maxPrice = $request['maxPriceRange'] ?? 99999999;
		$prices = [$minPrice, $maxPrice];

        $query = Product::where('id', '>', 1);


		$query->when($models, function ($query, $models) {
				return $query->whereIn('model_id', $models);
			})->when($brands, function ($query, $brands) {
				return $query->whereIn('brand_id', $brands);
			})->when($versions, function ($query, $versions) {
				return $query->whereIn('version_id', $versions);
			})->when($year, function ($query, $year) {
				return $query->where('year', $year);
			})->when($kms , function ($query, $kms) {
				Log::info("Kms: ");
				Log::info($kms);
				return $query->whereBetween('km', $kms);
			})->when($prices , function ($query, $prices) {
				Log::info("Precios: ");
				Log::info($prices);
				return $query->whereBetween('price', $prices);
		});


        return ProductResource::collection($query->get()->sortBy([
			['priority', 'asc']
		]));
    }

	public function search(array $data, int $paginate)
    {
		$keyWord = $data['filters'][0]['keyWord'];

        $ids = DB::table('product')
				->select('product.id')
				->join('model', 'product.model_id', '=', 'model.id')
				->join('brand', 'product.brand_id', '=', 'brand.id')
				->join('version', 'product.version_id', '=', 'version.id')
				->where('product.name', 'like', '%' . $keyWord . '%')
				->orWhere('model.description', 'like', '%' . $keyWord . '%')
				->orWhere('brand.name', 'like', '%' . $keyWord . '%')
				->orWhere('version.name', 'like', '%' . $keyWord . '%');
				/* $queryResponse = Product::where('name', 'like', '%' . $keyWord . '%')
					->whereNull("sold"); */

		$products = Product::whereIn('id', $ids)->get()->sortBy([
			['priority', 'asc']
		]);

		Log::info("Ids para busqueda");
        Log::info($ids->get());

        return ProductResource::collection($products);
		//return $queryResponse->get();
    }

	/**
	 * Function to set the resource sold
	 *
	 * @return void
	 */
	public function sold(int $id)
	{
		try {
			DB::transaction(function() use($data, $id){
				$this->model = Product::find($id);
				
				$field = ['sold' => true];
				$this->model->update($field);
			});

			return $this->model;
		} catch (QueryException $e) {
			Log::info($e->getMessage());
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}
		return false;
	}
}
