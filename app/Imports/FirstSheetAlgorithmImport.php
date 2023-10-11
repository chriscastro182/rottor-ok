<?php

namespace App\Imports;

use App\Models\MarketLaunch;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Version;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

class FirstSheetAlgorithmImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
		$saltar = true;
		foreach ($rows as $row) {
			if ($saltar) {
				$saltar = false;
				continue;
			}
			$marketToMatch = array();
            $marketData = array();
			if (!empty($row[0]) && $row[0] && $row[0] != 'MARCA' && $row[1] && $row[4] && $row[7]) {
				$brand = Brand::firstOrCreate([
					'name' => $row[0]
				]);
				$model = Model::firstOrCreate([
					'description' => $row[2],
					'brand_id' => $brand->id
				]);
                $version = Version::firstOrCreate([
                    'model_id' => $model->id,
                    'name' => empty($row[3]) ? 'N/A': $row[3],
					'year' => $row[1]
                ]);
				$marketData['brand_id'] = $brand->id;
                $marketData['model_id'] = $model->id;
                $marketData['version_id'] = $version->id;
				$marketData['year'] = $row[1];
				$marketData['cc'] = $row[4];
				$marketData['is_cashiable'] = $row[7] == 'S'?1:0;
				$marketData['full_payment'] = $row[8];
				$marketData['exchange_payment'] = $row[10];
				$marketData['allocation_payment'] = $row[12];

				Log::info("Data para guardar");
				Log::info($marketData);

				if($market = MarketLaunch::create($marketData))
                     Log::info("Se guardo la información");
                else
                    Log::info("No se pudo guardar la info: ".$market->message);
            }
        }
    }
}
