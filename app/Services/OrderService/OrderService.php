<?php

namespace App\Services\OrderService;

use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService implements \App\Services\BaseService\IBaseService, IOrderService
{
    private $model;

    public function create(array $data)
    {
        try {
            DB::transaction(function() use($data){
                $this->model = Order::create($data);
            });
            return $this->model;
        } catch (QueryException $e) {
            Log::info($e->getMessage());
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        return false;
    }

    public function update(array $data, int $id)
    {
        try {
            DB::transaction(function() use($data, $id){
                $this->model = Order::find($id);
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

    public function delete(int $id)
    {
        try {
            DB::transaction(function() use($id){
                $this->model = Order::find($id);
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

    public function get(int $id)
    {
        return Order::find($id);
    }

    public function all()
    {
        return Order::all();
    }

    public function paginate(int $page)
    {
        return Order::paginate($page);
    }
}