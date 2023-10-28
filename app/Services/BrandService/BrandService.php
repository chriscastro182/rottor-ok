<?php

namespace App\Services\BrandService;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MarketLaunch;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

/**
 * Class BrandService
 * @author Alberto Almazan
 */
class BrandService implements IBaseService, IBrandService
{
	private $model;

	/**
	 * Function to create the resource
	 * Returns the object resource when everything whent successful. False otherwise
	 *
	 * @return Object|boolean
	 */
	public function create(array $data)
	{
		try {
			DB::transaction(function() use($data){
				$this->model = Brand::create($data);
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
	 * Function taht updates the resource
	 *
	 * @return Object|boolean
	 */
	public function update(array $data, int $id)
	{
		try {
			DB::transaction(function() use($data, $id){
				$this->model = Brand::find($id);
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
				$this->model = Brand::find($id);
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
		return Brand::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
	public function all()
	{
		return BrandResource::collection(Brand::all());
	}
	
	/**
	 * Function that retrieves all the resources
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
	public function allonSale()
	{
		$productModelIds = Product::all()->pluck('brand_id');
		return BrandResource::collection(Brand::whereIn('id', $productModelIds)->get());
	}

	public function allFecha(int $year)
	{
		Log::info('year: '.$year);
		$brandIds = MarketLaunch::where('year', $year)->get();
		$ids = $brandIds->pluck('brand_id');
		$brands = Brand::all()->whereIn('id', $ids);
		// Creamos los nuevos datos a traer
		/* $latestCreatedAt = DB::table('brand')
			->rightJoin('market_launch', 'brand.id', '=', 'market_launch.brand_id')
			->select(DB::raw('LEFT(MAX(market_launch.created_at), 14)'))
			->value('created_at');
		Log::info('latestCreatedAt '.$latestCreatedAt);
		$brands = DB::table('brand')
			->select('brand.name', 'brand.id', 'brand.description')
			->whereIn('brand.id', function ($query) use ($latestCreatedAt, $year) {
				$query->select('market_launch.brand_id')
					->from('brand')
					->rightJoin('market_launch', 'brand.id', '=', 'market_launch.brand_id')
					->whereRaw("market_launch.created_at LIKE CONCAT('$latestCreatedAt', '%')")
					->where('market_launch.year', '=', $year);
			})
			->distinct()
			->get(); */
			// ->toSql();
		// Log::info('brands '.$brands);
		
		
			// ->get();
		// imprimimos en consola los datos anteriores

		// return BrandResource::collection(Brand::all());
		// traemos los datos de brand donde sean iguales a los que se traen en la variable results
		return BrandResource::collection($brands);

	}
	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Brand::paginate($page);
	}

    public function getBrands($brand_id)
    {
        $brand = Brand::find($brand_id);

        return $brand->models()->get();
    }
}
