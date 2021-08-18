<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmiHistoryPostRequest;
use App\Interfaces\EmiHistoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Auth;

class EmiCalculatorController extends Controller
{
    protected $history;

    public function __construct(EmiHistoryRepositoryInterface $history){
        $this->history = $history;
    }

    public function index(){
        return View::make('emicalculator.index');
    }

    public function createHistory(EmiHistoryPostRequest $request){
        // except token and method
        $data = $request->except(['_token','_method']);
        $data['user_id'] = Auth::user()->id;

        // create new records
        $history = $this->history->create($data);
        return redirect()->route('emi-calculator.view', array('id' => $history->history_id));
    }

    public function history(){
        $id = Auth::user()->id;

        //get history of user
        $histories = $this->history->getHistoryByUserId($id);
        return View::make('emicalculator.lists', compact('histories'));
    }

    public function getEmiDetails($id){
        $user_id = Auth::user()->id;

        // get emi details
        $history = $this->history->getHistoryByHistoryIdAndUserId($id, $user_id);
        return View::make('emicalculator.details', compact('history'));
    }
}
