<?php

namespace App\Services\CustomMarketService;

interface ICustomMarketService
{
    public function searchByDate($start_date, $end_date);

    public function reportByDate($start_date, $end_date);

    public function reportMostBikesQuotes();

    public function reportLessBikesQuotes();

    public function reportLessCCQuotes();

    public function reportMostCCQuotes();

    public function reportMostKMQuotes();

    public function reportLessKMQuotes();

    public function reportMostDateQuotes();

    public function reportLessDateQuotes();
}
