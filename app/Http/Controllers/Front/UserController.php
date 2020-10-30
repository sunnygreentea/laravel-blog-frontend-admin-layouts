<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function show($id) {
    	$user = User::find($id);
    	print_r($user->toArray());

    }
}
