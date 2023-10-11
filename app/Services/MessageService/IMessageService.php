<?php

namespace App\Services\MessageService;

/**
 * Interface IMessageService
 * @author Alberto Almazan
 */
interface IMessageService
{
	public function getLastMessageByCustomer(int $id);

    public function reportByDate($start_date, $end_date);

    public function searchByDate(string $start_date, string $end_date);
}
