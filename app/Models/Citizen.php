<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Citizen extends Model
{
    protected $table = 'voter_lists';


}
