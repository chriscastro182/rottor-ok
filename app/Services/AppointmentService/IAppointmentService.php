<?php

namespace App\Services\AppointmentService;

interface IAppointmentService
{
    public function assignProduct($appointment_id, $product_id);

    public function reportByDate($start_date, $end_date);

    public function searchByDate(string $start_date, string $end_date);

    public function getForProducts();

    public function getForQuotations();
}
