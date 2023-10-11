<?php

namespace App\Services\KMService;

use App\Models\Km;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class KMService implements IBaseService, IKMService
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
				$this->model = Km::create($data);
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
				$this->model = Km::find($id);
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
				$this->model = Km::find($id);
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
		return Km::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Km::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Km::paginate($page);
	}
}
