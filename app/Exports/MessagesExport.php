<?php

namespace App\Exports;

use App\Services\MessageService\MessageService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MessagesExport implements FromCollection, WithMapping, WithHeadings
{
    private $start_date;
    private $end_date;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $messageService = new MessageService();
        return $messageService->reportByDate($this->start_date, $this->end_date);
    }

    public function headings(): array
    {
        return array(
            __('customer.name'),
            __('customer.email'),
            __('customer.phone'),
            __('customer.cellphone'),
            __('message.subject'),
            __('message.message'),
        );
    }

    public function map($message): array
    {
        return array(
            $message->customer->name . ' ' . $message->customer->lastname,
            $message->customer->email,
            $message->customer->phone,
            $message->customer->cellphone,
            $message->subject,
            $message->message,
        );
    }

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
}
