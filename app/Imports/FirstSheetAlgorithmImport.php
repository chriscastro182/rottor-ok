<?php

namespace App\Imports;

use Exception;
use App\Models\MarketLaunch;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Version;
use Illuminate\Support\Collection;
use App\Exceptions\Handler;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Illuminate\Support\Facades\Log;

class FirstSheetAlgorithmImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
		foreach ($rows as $row) {

			$marketToMatch = array();
			$marketData = array();
			
			$brand = Brand::firstWhere( 'name', $row['marca'] );
			if (!$brand) {
				Log::info("No existe la marca: ".$row['marca']);
				throw new Exception("Marca inexistente: ".$row['marca'], 1);
				
			} else {
				$model = Model::firstOrCreate([
					'description' => $row['modelo'],
					'brand_id' => $brand->id
				]);
				$version = Version::firstOrCreate([
					'model_id' => $model->id,
					'name' => $row['version'],
					'year' => $row['ano']
				]);

				$marketData['brand_id'] = $brand->id;
				$marketData['model_id'] = $model->id;
				$marketData['version_id'] = $version->id;
				$marketData['year'] = $row['ano'];
				$marketData['cc'] = $row['motor'];
				$marketData['is_cashiable'] = $row['efectivo'];
				$marketData['full_payment'] = $row['contado'];
				$marketData['exchange_payment'] = $row['intercambio'];
				$marketData['allocation_payment'] = $row['allocation'];

				Log::info("Data para guardar desde Excel a MarketLaunch");
				Log::info($marketData);

				$objMarket = MarketLaunch::where('brand_id', $brand->id)
							->where('model_id', $model->id)
							->where('version_id',$version->id)
							->where('year',$row['ano'])
							->where('cc', $row['motor'])->first();
				//dd($marketData);
				
				if (!$objMarket) {
					if($market = MarketLaunch::create($marketData))
						Log::info("Se guardo la información");
					else
						Log::info("No se pudo guardar la info: ".$market->message);
				} else {
					$objMarket['is_cashiable'] = $row['efectivo'];
					$objMarket['full_payment'] = $row['contado'];
					$objMarket['exchange_payment'] = $row['intercambio'];
					$objMarket['allocation_payment'] = $row['allocation'];

					if($objMarket->update())
						Log::info("Se actualizó la información");
					else
						Log::info("No se pudo actualizar ");
				}

			}
		}
    }
}
