<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class Product extends Model
{
    use HasFactory, HasUuid, SoftDeletes, Userstamps;

    public $entity = "product";

    public $filters = ["name",/*  "category" */];

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'category_id',
        'image'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
