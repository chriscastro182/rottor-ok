<?php

namespace App\Imports;

use App\Models\MarketLaunch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Illuminate\Support\Facades\Log;


class MarketLaunchImport implements WithMultipleSheets
{
	use WithConditionalSheets;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MarketLaunch([
            //
        ]);
    }

	/**
	 * undocumented function
	 *
	 * @return void
	 */
	public function conditionalSheets():array
	{
		return [
			'ALGORITMO' => new FirstSheetAlgorithmImport(),
			'FACTOR KM' => new SecondSheetAlgorithmImport()
		];
	}
	
	
}
