<?php

namespace App\Services\MessageService;

use App\Models\Message;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

/**
 * Class MessageService
 * @author Alberto Almazan
 */
class MessageService implements IBaseService, IMessageService
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
				$this->model = Message::create($data);
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
				$this->model = Message::find($id);
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
				$this->model = Message::find($id);
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
		return Message::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Message::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Message::orderBy('id', 'desc')->paginate($page);
	}

	/**
	 * Function to retrieve the last message from a customer
	 *
	 * @return App\Models\Message
	 */
	public function getLastMessageByCustomer(int $id)
	{
		Log::info("Se obtiene el ultimo mensaje");
		$messages = Message::where('customer_id', $id)->orderBy('created_at', 'desc')->first();
		Log::info($messages);

		return $messages;
	}

    public function reportByDate($start_date, $end_date)
    {
        return $this->searchByDate($start_date, $end_date);
    }

    public function searchByDate(string $start_date, string $end_date)
    {
        return Message::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->get();
    }
}
