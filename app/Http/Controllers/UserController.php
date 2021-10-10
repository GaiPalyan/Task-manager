<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('user.auth');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = new User();
        $user->fill($data);
        $user->save();

        return redirect()->route('main');
    }
}
