<?php


namespace App\Http\Controllers;
use App\Http\Requests\TimeTablePostRequest;
use App\Interfaces\TimeTableRepositoryInterface;
use App\Services\TimeTableGenerator;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    protected $history;
    public function __construct(TimeTableRepositoryInterface $history){
        $this->history = $history;
    }

    public function step1(){
        return View::make('timetable.step1');
    }

    public function create(TimeTablePostRequest $request){
        // validation for total subjects are not more than total working hours
        if(($request->get('working_days') * $request->get('subjects_per_day')) < $request->get('total_subjects')){
            $subjects = $request->get('working_days') * $request->get('subjects_per_day');
            return Redirect::back()->withErrors(['msg' => "The total subjects must be less than or equal $subjects."]);
        }

        // except token and method
        $data = $request->except(['_token','_method']);
        $data['user_id'] = Auth::user()->id;

        // create new records
        $history = $this->history->create($data);
        return redirect()->route('timetable.step2', array('id' => $history->history_id));
    }

    public function getTimeTableDetails($id){
        $user_id = Auth::user()->id;

        // get time table details
        $history = $this->history->getHistoryByHistoryIdAndUserId($id, $user_id);
        return View::make('timetable.step2', compact('history'));
    }

    public function generateTimeTable(Request $request, $id){
        $customMessages = [];
        foreach ($request->get('subjects') as $key => $value) {
            $val = $key+1;
            $customMessages['subjects.' . $key. '.min'] = "The subject $val must be at least :min hours";
            $customMessages['subjects.' . $key. '.integer'] = "The subject $val must be integer";
        }

        $validated = $this->validate($request, [
            'subjects' => "required|array|min:1",
            'subjects.*' => "required|integer|min:1"
        ], $customMessages);

        $user_id = Auth::user()->id;
        $history = $this->history->getHistoryByHistoryIdAndUserId($id, $user_id);
        if(empty($history)){
            abort(404);
        }
        if($history->totalWeeklyHours != array_sum($request->get('subjects'))){
            return Redirect::back()->withErrors(['msg' => "Total of the subjects values must be equal to $history->totalWeeklyHours"]);
        }
        $time_table_generator = new TimeTableGenerator($history->working_days, $history->subjects_per_day, $history->total_subjects);
        $timetable = $time_table_generator->generate($request->get('subjects'));
        return View::make('timetable.view', compact('timetable'));
    }
}
