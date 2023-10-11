<?php

namespace App\Services\AttachmentService;

use App\Models\Attachment;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class AttachmentService implements IBaseService, IAttachmentService
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
				$this->model = Attachment::create($data);
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
				$this->model = Attachment::find($id);
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
				$this->model = Attachment::find($id);
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
		return Attachment::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Attachment::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Attachment::paginate($page);
	}
}
