<?php

namespace App\Services\CustomMarketService;

use App\Models\CustomMarket;
use Cassandra\Custom;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomMarketService implements \App\Services\BaseService\IBaseService, ICustomMarketService
{
    private $model;

    public function create(array $data)
    {
        try {
            DB::transaction(function() use($data){
                $this->model = CustomMarket::create($data);
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
                $this->model = CustomMarket::find($id);
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
                $this->model = CustomMarket::find($id);
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
        return CustomMarket::find($id);
    }

    public function all()
    {
        return CustomMarket::all();
    }

    public function paginate(int $page)
    {
        return CustomMarket::orderBy('id', 'desc')->paginate($page);
    }

    public function reportByDate($start_date, $end_date)
    {
        return $this->searchByDate($start_date, $end_date);
    }

    public function reportMostBikesQuotes()
    {
        $data = CustomMarket::select(DB::raw('count(*) as ocurrencias, model, brand, year'))
            ->groupBy('model')
            ->orderByDesc('ocurrencias')
            ->limit(5)
            ->get();

        Log::info($data);
        return $data;
    }

    public function reportLessBikesQuotes()
    {
        return CustomMarket::select(DB::raw('count(*) as ocurrencias, model, brand, year'))
            ->groupBy('model')
            ->orderBy('ocurrencias')
            ->limit(5)
            ->get();
    }

    public function reportLessCCQuotes()
    {
        $data = CustomMarket::select(DB::raw('count(*) as ocurrencias, model, brand, year, cc'))
            ->groupBy('cc')
            ->orderBy('ocurrencias')
            ->limit(5)
            ->get();

        return $data;
    }

    public function reportMostCCQuotes()
    {
        $data = CustomMarket::select(DB::raw('count(*) as ocurrencias, model, brand, year, cc'))
            ->groupBy('cc')
            ->orderByDesc('ocurrencias')
            ->limit(5)
            ->get();
        return $data;
    }

    public function reportMostKMQuotes()
    {
        return CustomMarket::select(DB::raw('count(*) as ocurrencias, model, brand, year, km'))
            ->groupBy('km')
            ->orderByDesc('ocurrencias')
            ->limit(5)
            ->get();
    }

    public function reportLessKMQuotes()
    {
        return CustomMarket::select(DB::raw('count(*) as ocurrencias, model, brand, year, km'))
            ->groupBy('km')
            ->orderBy('ocurrencias')
            ->limit(5)
            ->get();
    }

    public function reportMostDateQuotes()
    {
        return CustomMarket::select(DB::raw('count(*) as ocurrencias, DATE(created_at) as fecha, TIME(created_at) as hora'))
            ->groupBy('fecha')
            ->orderByDesc('ocurrencias')
            ->limit(5)
            ->get();
    }

    public function reportLessDateQuotes()
    {
        return CustomMarket::select(DB::raw('count(*) as ocurrencias, DATE(created_at) as fecha, TIME(created_at) as hora'))
            ->groupBy('fecha')
            ->orderBy('ocurrencias')
            ->limit(5)
            ->get();
    }

    public function searchByDate($start_date, $end_date)
    {
        return CustomMarket::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->get();
    }
}
