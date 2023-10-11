<?php

namespace App\Imports;

use App\Models\Factor;
use App\Models\Km;
use App\Models\Motor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

class SecondSheetAlgorithmImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
		$cont = 1;
		foreach($rows as $row){
			Log::info("Informacion de la fila");
			Log::info($row);

			if ($cont>=7 && $cont<=14) {
				Log::info("Guardamos data");
				$km = Km::firstOrCreate([
					'min_km' => $row[0],
					'max_km' => $row[1]
				]);

				$motor = Motor::firstOrCreate([
					'min_cc' => 0,
					'max_cc' => 299
				]);

				$this->insertFactor($km, $motor, 2021, $row[2]);
				$this->insertFactor($km, $motor, 2020, $row[3]);
				$this->insertFactor($km, $motor, 2019, $row[4]);
				$this->insertFactor($km, $motor, 2018, $row[5]);
				$this->insertFactor($km, $motor, 2017, $row[6]);
				$this->insertFactor($km, $motor, 2016, $row[7]);
				$this->insertFactor($km, $motor, 2015, $row[8]);


			}

			if ($cont>=20 && $cont<=27) {
				Log::info("Guardamos data");
				$km = Km::firstOrCreate([
					'min_km' => $row[0],
					'max_km' => $row[1]
				]);

				$motor = Motor::firstOrCreate([
					'min_cc' => 300,
					'max_cc' => 499
				]);

				$this->insertFactor($km, $motor, 2021, $row[2]);
				$this->insertFactor($km, $motor, 2020, $row[3]);
				$this->insertFactor($km, $motor, 2019, $row[4]);
				$this->insertFactor($km, $motor, 2018, $row[5]);
				$this->insertFactor($km, $motor, 2017, $row[6]);
				$this->insertFactor($km, $motor, 2016, $row[7]);
				$this->insertFactor($km, $motor, 2015, $row[8]);
			}

			if ($cont>=33 && $cont<=39) {
				Log::info("Guardamos data");
				$km = Km::firstOrCreate([
					'min_km' => $row[0],
					'max_km' => $row[1]
				]);

				$motor = Motor::firstOrCreate([
					'min_cc' => 500,
					'max_cc' => 699
				]);

				$this->insertFactor($km, $motor, 2021, $row[2]);
				$this->insertFactor($km, $motor, 2020, $row[3]);
				$this->insertFactor($km, $motor, 2019, $row[4]);
				$this->insertFactor($km, $motor, 2018, $row[5]);
				$this->insertFactor($km, $motor, 2017, $row[6]);
				$this->insertFactor($km, $motor, 2016, $row[7]);
				$this->insertFactor($km, $motor, 2015, $row[8]);
			}

			if ($cont>=45 && $cont<=53) {
				Log::info("Guardamos data");
				$km = Km::firstOrCreate([
					'min_km' => $row[0],
					'max_km' => $row[1]
				]);

				$motor = Motor::firstOrCreate([
					'min_cc' => 700,
					'max_cc' => 899
				]);

				$this->insertFactor($km, $motor, 2021, $row[2]);
				$this->insertFactor($km, $motor, 2020, $row[3]);
				$this->insertFactor($km, $motor, 2019, $row[4]);
				$this->insertFactor($km, $motor, 2018, $row[5]);
				$this->insertFactor($km, $motor, 2017, $row[6]);
				$this->insertFactor($km, $motor, 2016, $row[7]);
				$this->insertFactor($km, $motor, 2015, $row[8]);
			}

			if ($cont>=59 && $cont<=66) {
				Log::info("Guardamos data");
				$km = Km::firstOrCreate([
					'min_km' => $row[0],
					'max_km' => $row[1]
				]);

				$motor = Motor::firstOrCreate([
					'min_cc' => 900,
					'max_cc' => 99999
				]);

				$this->insertFactor($km, $motor, 2021, $row[2]);
				$this->insertFactor($km, $motor, 2020, $row[3]);
				$this->insertFactor($km, $motor, 2019, $row[4]);
				$this->insertFactor($km, $motor, 2018, $row[5]);
				$this->insertFactor($km, $motor, 2017, $row[6]);
				$this->insertFactor($km, $motor, 2016, $row[7]);
				$this->insertFactor($km, $motor, 2015, $row[8]);
			}

			$cont++;	
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
