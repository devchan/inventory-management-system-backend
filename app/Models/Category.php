<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class Category extends Model
{
    use HasFactory, HasUuid, SoftDeletes, Userstamps;

    public $entity = "category";

    public $filters = ["name"];

    protected $fillable = [
        'name',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);

    }
}
