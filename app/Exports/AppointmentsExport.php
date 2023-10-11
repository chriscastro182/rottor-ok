<?php

namespace App\Exports;

use App\Services\AppointmentService\AppointmentService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AppointmentsExport implements FromCollection, WithHeadings, WithMapping
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
        $appointmentService = new AppointmentService();
        return $appointmentService->reportByDate($this->start_date, $this->end_date);
    }

    public function headings(): array
    {
        return array(
            __('customer.name'),
            __('customer.email'),
            __('customer.phone'),
            __('customer.cellphone'),
            __('appointment.date'),
            __('appointment.hour'),
            __('appointment.reason'),
        );
    }

    public function map($appointment): array
    {
        $reason = "N/A";
        if ($appointment->quotations()->count() > 0){
            $reason = __('appointment.has_quotations');
        }elseif ($appointment->orders()->count() > 0){
            $reason = __('appointment.has_orders');
        }elseif($appointment->customMarkets()->count() > 0){
            $reason = __('appointment.has_custom');
        }
        return array(
            $appointment->customer->name . ' ' . $appointment->customer->lastname,
            $appointment->customer->email,
            $appointment->customer->phone,
            $appointment->customer->cellphone,
            $appointment->day,
            $appointment->hour,
            $reason
        );
    }
}
