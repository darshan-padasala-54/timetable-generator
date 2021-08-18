<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmiHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emi_history';
    protected $primaryKey = 'history_id';

    protected $fillable = [
        'principal_amount',
        'rate_of_interest',
        'user_id',
        'durations',
    ];

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }
}
