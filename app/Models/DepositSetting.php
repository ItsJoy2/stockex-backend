<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepositSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bonus_percentage',
        'status'
    ];
}
