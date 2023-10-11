<?php

namespace App\Services\QuotationService;

use App\Models\Quotation;
use App\Services\BaseService\IBaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class QuotationService implements IBaseService, IQuotationService
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
				$this->model = Quotation::create($data);
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
				$this->model = Quotation::find($id);
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
				$this->model = Quotation::find($id);
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
		return Quotation::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return Quotation::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return Quotation::paginate($page);
	}

    public function quotateMarkets($markets, $extra_data)
    {
        if (is_array($markets) && count($markets)>0){
            foreach ($markets as $market) {
                return $this->create([
                    'market_launch_id' => $market['id'],
                    'km' => $extra_data['km'],
                    'import' => $market['full_payment'],
                    'total' => $market['exchange_payment'],
                    'discount_factor' => $extra_data['factor'],
                    'is_cash' => $market['is_cashiable']
                ]);
            }
        }

        return false;
    }

    public function quotateMarket($market_data, $extra_data)
    {
        return $this->create([
            'market_launch_id' => $market_data['id'],
            'km' => $extra_data['km'],
            'import' => $market_data['full_payment'],
            'total' => $market_data['exchange_payment'],
            'discount_factor' => $extra_data['factor'],
            'is_cash' => $market_data['is_cashiable']
        ]);
    }

    public function getMostBrands()
    {
        return Quotation::select(DB::raw('count(*) as ocurrencias, brand.name, market_launch.year'))
            ->join('market_launch', 'quotation.market_launch_id', '=', 'market_launch.id')
            ->join('brand', 'market_launch.brand_id', '=', 'brand.id')
            ->groupBy('brand_id')
            ->orderBy('ocurrencias', 'desc')
            ->limit(5)
            ->get();
    }

    public function getLessBrands()
    {
        return Quotation::select(DB::raw('count(*) as ocurrencias, brand.name, market_launch.year'))
            ->join('market_launch', 'quotation.market_launch_id', '=', 'market_launch.id')
            ->join('brand', 'market_launch.brand_id', '=', 'brand.id')
            ->groupBy('brand_id')
            ->orderBy('ocurrencias', 'asc')
            ->limit(5)
            ->get();
    }

    public function getMostVersions()
    {
        return Quotation::select(DB::raw('count(*) as ocurrencias, version.name, market_launch.year'))
            ->join('market_launch', 'quotation.market_launch_id', '=', 'market_launch.id')
            ->join('version', 'market_launch.version_id', '=', 'version.id')
            ->groupBy('version_id')
            ->orderBy('ocurrencias', 'desc')
            ->limit(5)
            ->get();
    }

    public function getLessVersions()
    {
        return Quotation::select(DB::raw('count(*) as ocurrencias, version.name, market_launch.year'))
            ->join('market_launch', 'quotation.market_launch_id', '=', 'market_launch.id')
            ->join('version', 'market_launch.version_id', '=', 'version.id')
            ->groupBy('version_id')
            ->orderBy('ocurrencias', 'asc')
            ->limit(5)
            ->get();
    }

    public function getMostCC()
    {
        return Quotation::select(DB::raw('count(*) as ocurrencias, market_launch.cc, market_launch.year'))
            ->join('market_launch', 'quotation.market_launch_id', '=', 'market_launch.id')
            ->groupBy('market_launch.cc')
            ->orderBy('ocurrencias', 'desc')
            ->limit(5)
            ->get();
    }

    public function getLessCC()
    {
        return Quotation::select(DB::raw('count(*) as ocurrencias, market_launch.cc, market_launch.year'))
            ->join('market_launch', 'quotation.market_launch_id', '=', 'market_launch.id')
            ->groupBy('market_launch.cc')
            ->orderBy('ocurrencias', 'asc')
            ->limit(5)
            ->get();
    }
}
