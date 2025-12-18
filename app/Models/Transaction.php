<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'user_id',
        'waste_category_id',
        'weight',
        'price_per_kg',
        'total_price',
        'status',
    ];


    protected $casts = [
        'weight' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(WasteCategory::class, 'waste_category_id');
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }

}
