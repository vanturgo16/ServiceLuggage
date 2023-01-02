<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_location',
        'id_bank'
    ];
}
