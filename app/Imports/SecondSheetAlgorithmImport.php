<?php

namespace App\Imports;

use App\Models\Factor;
use App\Models\Km;
use App\Models\Motor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class SecondSheetAlgorithmImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
		foreach($rows as $row){
			Log::info("Informacion de la fila");
			Log::info($row);
			//dd($row);
			$km = Km::firstOrCreate([
				'min_km' => $row['km_minimo'],
				'max_km' => $row['km_maximo']
			]);

			$motor = Motor::firstOrCreate([
				'min_cc' => $row['motor_minimo'],
				'max_cc' => $row['motor_maximo']
			]);

			$objFactor = Factor::where('km_id', $km->id)
						->where('motor_id', $motor->id)
						->where('year', $row['ano'])->first();

			if (!$objFactor) {
				$this->insertFactor($km, $motor, $row['ano'], $row['porcentaje']);
			} else {
				$objFactor['percentage'] = $row['porcentaje'];				
				if($objFactor->update())
					Log::info("Se actualizó la información del factor");
				else
					Log::info("No se pudo actualizar el factor");
			}
		}
    }

	/**
	 * Function to insert the factor according to data
	 *
	 * @return boolean
	 */
	private function insertFactor($km, $motor, $year, $percentage)
	{
		if (!is_numeric($percentage) )
			return false;
			
		$factorData['km_id'] = $km->id;
		$factorData['motor_id'] = $motor->id;
		$factorData['year'] = $year;
		$factorData['percentage'] = $percentage;
		Log::info("Data para guardar");
		Log::info($factorData);
		if( $factor = Factor::create($factorData) ){
			Log::info("Se guardo la información");
			return true;
		}

		return false;
	}
	
}
