<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * All attributes are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
