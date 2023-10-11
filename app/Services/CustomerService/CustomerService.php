<?php

namespace App\Services\CustomerService;

use App\Models\Customer;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class CustomerService implements ICustomerService
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
				$this->model = Customer::create($data);
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
				$this->model = Customer::find($id);
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
				$this->model = Customer::find($id);
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
		return Customer::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Customer::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Customer::paginate($page);
	}
	
	/**
	 * Function to login the user
	 */
	public function login(string $email, string $password)
	{
		$customer = Customer::where('email', $email)
			->where('password', md5($password))
			->first();

		if ($customer) {
			return $customer;
		}

		return false;
	}

	/**
	 * Function that retrieves the customer by email
	 *
	 * @return Customer|boolean
	 */
	public function getByEmail(string $email)
	{
		return Customer::where('email', $email)->first();;
	}
	
	
}
