<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
        protected $guarded = ['id'];

    use HasFactory;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
