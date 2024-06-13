<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'particular',
        'amount',
        'type',
        'category_id'
    ];


    protected $with =[
        'category'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
