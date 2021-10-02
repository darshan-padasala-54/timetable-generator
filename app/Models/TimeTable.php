<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'timetable_history';
    protected $primaryKey = 'history_id';

    protected $fillable = [
        'working_days',
        'subjects_per_day',
        'user_id',
        'total_subjects',
    ];

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }

    public function getTotalWeeklyHoursAttribute(){
        return $this->subjects_per_day * $this->working_days;
    }
}
