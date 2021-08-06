<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user();
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        if($request->input('password')) {
            $request->merge([
                'password' => Hash::make($request->input('password'))
            ]);
        }
        $user = $request->user();
        $user->update($request->all());
        return $user;
    }
}
