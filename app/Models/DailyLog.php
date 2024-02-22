<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'log_text', 'log_file', 'status_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
