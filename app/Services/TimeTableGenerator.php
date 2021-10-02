<?php


namespace App\Services;


class TimeTableGenerator
{
    protected $working_days;
    protected $subjects_per_day;
    protected $total_subjects;
    protected $total_weekly_hours;
    protected $time_table = [];
    protected $subjects;

    public function __construct($working_days, $subjects_per_day, $total_subjects){
        $this->working_days = $working_days;
        $this->subjects_per_day = $subjects_per_day;
        $this->total_subjects = $total_subjects;
        $this->total_weekly_hours = $working_days * $subjects_per_day;
    }

    public function generate(array $subjects){
        $this->subjects = $subjects;
        $assigned_slots = 0;

        do{
            for($i = 0; $i < $this->working_days; $i++){
                foreach ($subjects as $key => $subject){
                    if(!$this->isSubjectBooked($key)){
                        if(!$this->isDayBooked($i)){
                            $this->time_table[$i][] = $key;
                            $assigned_slots++;
                        }
                    }
                }
            }
        }while($assigned_slots != $this->total_weekly_hours);

        $this->time_table = recursive_associative_shuffle($this->time_table);
        return $this->time_table;
    }

    public function isSubjectBooked($subject){
        $total_slots = $this->subjects[$subject];
        $count = 0;
        foreach ($this->time_table as $k => $value){
            foreach ($value as $key => $val){
                if($val == $subject){
                    $count ++;
                }
            }
        }
        if($total_slots == $count){
            return true;
        }
        return false;
    }

    public function isDayBooked($day){
        if(isset($this->time_table[$day])){
            return $this->subjects_per_day == count($this->time_table[$day]);
        }
        return false;
    }
}
