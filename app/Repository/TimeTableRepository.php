<?php


namespace App\Repository;

use App\Interfaces\TimeTableRepositoryInterface;
use App\Models\TimeTable;

class TimeTableRepository implements TimeTableRepositoryInterface
{
    public function create($data){
        return TimeTable::create($data);
    }

    public function getHistoryByHistoryIdAndUserId($history_id, $user_id)
    {
        return TimeTable::where('history_id',$history_id)->where('user_id', $user_id)->first();
    }
}
