<?php

namespace App\Services\CartService;

use App\Models\Cart;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService implements \App\Services\BaseService\IBaseService, ICartService
{
    private $model;

    public function create(array $data)
    {
        try {
            DB::transaction(function() use($data){
                $this->model = Cart::create($data);
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
                $this->model = Cart::find($id);
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
                $this->model = Cart::find($id);
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
        return Cart::find($id);
    }

    public function all()
    {
        return Cart::all();
    }

    public function paginate(int $page)
    {
        return Cart::paginate($page);
    }
}