<?php

namespace App\Services\VersionService;

use App\Models\Model;
use App\Models\Version;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VersionServcie implements IVersionService, \App\Services\BaseService\IBaseService
{
    private $model;

    public function create(array $data)
    {
        try {
            DB::transaction(function() use($data){
                $this->model = Version::create($data);
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
                $this->model = Version::find($id);
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
                $this->model = Version::find($id);
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
        return Version::find($id);
    }

    public function all()
    {
        return Version::all();
    }

    public function allOnSale()
    {
        $versionId = Product::all()->pluck('version_id');

        return Version::whereIn('id', $versionId)->get();
    }

    public function paginate(int $page)
    {
        return Version::paginate($page);
    }
}
