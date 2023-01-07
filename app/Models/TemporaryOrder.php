<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
		'id_location',
        'id_item',
        'item_qty',
        'item_cost',
        'total'
    ];
}
