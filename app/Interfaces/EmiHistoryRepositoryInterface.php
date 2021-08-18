<?php


namespace App\Interfaces;


interface EmiHistoryRepositoryInterface
{
    public function create($data);

    public function getHistoryByUserId($id);

    public function getHistoryByHistoryIdAndUserId($history_id, $user_id);
}
