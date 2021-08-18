<?php


namespace App\Repository;


use App\Interfaces\EmiHistoryRepositoryInterface;
use App\Models\EmiHistory;

class EmiHistoryRepository implements EmiHistoryRepositoryInterface
{

    public function create($data){
        return EmiHistory::create($data);
    }

    public function getHistoryByUserId($id){
        return EmiHistory::where('user_id', $id)->orderBy('history_id','desc')->paginate(10);
    }

    public function getHistoryByHistoryIdAndUserId($history_id, $user_id)
    {
        return EmiHistory::where('history_id',$history_id)->where('user_id', $user_id)->first();
    }
}
