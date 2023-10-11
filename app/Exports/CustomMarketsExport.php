<?php

namespace App\Exports;

use App\Services\CustomMarketService\CustomMarketService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomMarketsExport implements FromCollection, WithHeadings, WithMapping
{
    private $start_date;
    private $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $customMarketService = new CustomMarketService();
        return $customMarketService->reportByDate($this->start_date, $this->end_date);
    }

    public function headings(): array
    {
        return array(
            __('customer.name'),
            __('customer.email'),
            __('customer.phone'),
            __('customer.cellphone'),
            __('customMarket.brand'),
            __('customMarket.model'),
            __('customMarket.year'),
            __('customMarket.cc'),
            __('customMarket.km'),
        );
    }

    public function map($customMarket): array
    {
        return array(
            $customMarket->customers()->first()->name . ' ' . $customMarket->customers()->first()->lastname,
            $customMarket->customers()->first()->email,
            $customMarket->customers()->first()->phone,
            $customMarket->customers()->first()->cellphone,
            $customMarket->brand,
            $customMarket->model,
            $customMarket->year,
            $customMarket->cc,
            $customMarket->km
        );
    }
}
