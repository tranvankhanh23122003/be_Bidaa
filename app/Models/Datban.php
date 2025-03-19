<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datban extends Model
{
    use HasFactory;
    protected $fillable = [
        "booking_date",
        "booking_time",
        "billiard_type",
        "table_id",

    ];
    protected $table = 'dat_ban';
}
