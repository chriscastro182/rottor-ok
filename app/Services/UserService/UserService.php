<?php

namespace App\Services\UserService;

use App\User;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


class UserService implements IUserService, IBaseService 
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
				$this->model = User::create($data);
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
				$this->model = User::find($id);
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
				$this->model = User::find($id);
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
		return User::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return User::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return User::paginate($page);
	}
	
	/**
	 * Function to login the user
	 */
	public function login(string $email, string $password)
	{
	}

	public function logout()
	{
	}
}
