<?php

namespace App\Services\MarketLaunchService;

use App\Models\MarketLaunch;
use App\Models\Factor;
use App\Models\Motor;
use App\Services\BaseService\IBaseService;
use App\Services\QuotationService\QuotationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class MarketLaunchService implements IBaseService, IMarketLaunchService
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
				$this->model = MarketLaunch::create($data);
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
				$this->model = MarketLaunch::find($id);
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
				$this->model = MarketLaunch::find($id);
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
		return MarketLaunch::find($id);
	}

	/**
	 * Function that retrieves all the resources
	 *
	 * @return array
	 */
	public function all()
	{
		return MarketLaunch::all();
	}

	/**
	 * Function that retrieve the resources paginated
	 *
	 * @return array
	 */
	public function paginate(int $page)
	{
		return MarketLaunch::paginate($page);
	}

	/**
	 * Function to retrieve the algorithm data
	 *
	 * @return array
	 */
	public function getCotization($data)
	{
		$marketResults = array();
        $quoteService = new QuotationService();

		$market =  MarketLaunch::where('brand_id', $data['brand'])
			->where('model_id', $data['model'])
            ->where('version_id', $data['version'])
			->where('year', $data['year'])
			->orderBy('id', 'desc')
			->first();
			

		Log::info($data['brand']);
		Log::info($data['model']);
		Log::info($data['version']);
		Log::info($data['year']);
		
		//contamos cuantos resultados trajo la consulta
		Log::info("contamos los resultados");
		Log::info($market->id);
		Log::info($market->count());
//		foreach ($markets as $market) {
			Log::info("Informacion del mercadeo");
			Log::info($market);

			Log::info("Se obtiene la información del motor");
			$motor = Motor::where('min_cc', '<=', $market->cc)
				->where('max_cc', '>=', $market->cc)
				->first();
			Log::info($motor);

			Log::info("Se obtiene la información del factor");
			$factor = Factor::where('km_id', $data['km'])
				->where('motor_id', $motor->id)
				->where('year', $data['year'])
				->first();
			Log::info($factor);

            $marketResult['id'] = $market->id;
			$marketResult['brand_id'] = $market->brand_id;
			$marketResult['model_id'] = $market->model_id;
			$marketResult['year'] = $market->year;
			$marketResult['cc'] = $market->cc;
            if ($factor){
                $marketResult['is_cashiable'] = $market->is_cashiable;
				if($marketResult['is_cashiable']){
					$marketResult['full_payment'] = $market->full_payment + ($market->full_payment*$factor->percentage);
					$marketResult['exchange_payment'] = $market->exchange_payment + ($market->exchange_payment*$factor->percentage);
				}else{
					$marketResult['full_payment'] = 0;
					$marketResult['exchange_payment'] = 0;
				}					
                $marketResult['allocation_payment'] = $market->allocation_payment + ($market->allocation_payment*$factor->percentage);
				Log::info("Se guardan los datos de cotizacion");
				$quoteInserted = $quoteService->quotateMarket($marketResult, [
					'factor' => $factor->percentage,
					'km' => $data['km']
				]);
				if($quoteInserted){
					$marketResult['quote_id'] = $quoteInserted->id;
				}
				$marketResults[] = $marketResult;
            }else{
                $marketResult['is_cashiable'] = $market->is_cashiable;
                $marketResult['full_payment'] = $market->full_payment;
                $marketResult['exchange_payment'] = $market->exchange_payment;
                $marketResult['allocation_payment'] = $market->allocation_payment;
            }


//		}
		Log::info('Se obtienen los datos finales');
		Log::info($marketResults);

		return $marketResults;
	}

    public function getMostBrandsQuote()
    {
        return MarketLaunch::select(DB::raw('count(*) as ocurrencias, brand.name, market_launch.year'))
            ->join('brand', 'market_launch.brand_id', '=', 'brand.id')
            ->groupBy('brand_id')
            ->orderBy('ocurrencias', 'desc')
            ->limit(5)
            ->get();
    }

    public function getLessBrandsQuote()
    {
        return MarketLaunch::select(DB::raw('count(*) as ocurrencias, brand.name, market_launch.year'))
            ->join('brand', 'market_launch.brand_id', '=', 'brand.id')
            ->groupBy('brand_id')
            ->orderBy('ocurrencias', 'asc')
            ->limit(5)
            ->get();
    }
}
