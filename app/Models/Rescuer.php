<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Rescuer extends Model
{
    public const VALIDATION_RULES = [
        "first_name" => ["required", "alpha", "min:3"],
        "last_name" => ["required", "alpha", "min:3"],
        "phone_number" => ["required", "numeric", "min:6"],
        "images" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "rescuers";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    //public function Animal()
    //{
    //  return $this->hasMany(Animal::class);
    //}
}
