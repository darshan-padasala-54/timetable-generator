<?php


namespace App\Interfaces;


interface TimeTableRepositoryInterface
{
    public function create($data);

    public function getHistoryByHistoryIdAndUserId($history_id, $user_id);
}
