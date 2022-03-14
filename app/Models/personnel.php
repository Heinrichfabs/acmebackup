<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Personnel extends Model
{
    public const VALIDATION_RULES = [
        "full_name" => ["required", "min:5"],
        "email" => ["required", "unique:personnels"],
        "password" => ["required", "min:5"],
        "role" => ["required", "alpha"],
        "images" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "personnels";

    protected $primaryKey = "personnel_id";

    protected $guarded = ["personnel_id"];
}
