<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'line_id', 
        'order_id', 
        'start_sewing', 
        'finish_sewing', 
        'qty_total_target', 
        'daily_target_output', 
        'actual_output'
    ];

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
