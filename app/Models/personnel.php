<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Personnel extends Authenticatable
{
    public const VALIDATION_RULES = [
        "full_name" => ["required", "string", "min:5"],
        "email" => ["required", "string", "email", "unique:personnels"],
        "password" => ["required", "min:5", "confirmed"],
    ];

    protected $dates = ["deleted_at"];

    protected $table = "personnels";

    protected $primaryKey = "personnel_id";

    protected $guarded = ["personnel_id"];

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["full_name", "email", "password", "role"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];
}

