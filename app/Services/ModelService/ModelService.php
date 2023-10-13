<?php

namespace App\Services\ModelService;

use App\Models\Model;
use App\Models\Product;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

/**
 * Class ModelService
 * @author Alberto Almazan
 */
class ModelService implements IBaseService, IModelService
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
				$this->model = Model::create($data);
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
				$this->model = Model::find($id);
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
				$this->model = Model::find($id);
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
		return Model::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Model::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Model::paginate($page);
	}

	/**
	 * Function to retrieve the models by brand
	 *
	 * @return array
	 */
	public function byBrand($year,$brand_id)
	{
		$latestCreatedAt = DB::table('model')
			->rightJoin('market_launch', 'model.id', '=', 'market_launch.model_id')
			->select(DB::raw('LEFT(MAX(market_launch.created_at), 14)'))
			->value('created_at');
		Log::info('latestCreatedAt '.$latestCreatedAt);
		$models = DB::table('model')
			->select('model.description', 'model.id', 'model.brand_id')
			->whereIn('model.id', function ($query) use ($latestCreatedAt, $year, $brand_id) {
				$query->select('market_launch.model_id')
					->from('model')
					->rightJoin('market_launch', 'model.id', '=', 'market_launch.model_id')
					->where('model.brand_id', '=', $brand_id)
					->whereRaw("market_launch.created_at LIKE CONCAT('$latestCreatedAt', '%')")
					->where('market_launch.year', '=', $year);
			})
			->distinct()
			->get();
		return $models;
	}

    public function getVersions($model_id)
    {
        $model = Model::find($model_id);

        return $model->version()->get();
    }

	/**
	 * Function that retrieves all the resources on sale
	 *
	 * @return array
	 */
	public function allOnSale()
	{
		$productIds = Product::all()->pluck('model_id');
		return Model::whereIn('id', $productIds)->get();
	}
}
