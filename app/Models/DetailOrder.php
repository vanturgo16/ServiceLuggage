<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_order',
        'id_item',
        'item_qty',
        'item_cost',
        'total'
    ];
}
