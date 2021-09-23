<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function info()
    {
        return new UserResource(Auth::user());
    }
}
