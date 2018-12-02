<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Transformers\UserTransformer;
use Auth;

class UserController extends Controller
{
    //list user

    public function users(User $user)
    {
        $users = $user->all();

        return fractal()
        ->collection($users)
        ->transformWith(new USerTransformer)
        ->toArray();

        return response()->json($users);

    }

    public function profile(User $user)
    {
        $user = $user->find(Auth::user()->id);
        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->includePosts()
            ->toArray();
    }
}

