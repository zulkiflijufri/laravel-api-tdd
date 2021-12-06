<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::latest()->get());
    }

    public function store()
    {
        $attributes = (new UserValidator())->validate(
            $user = new User(),
            request()->all()
        );

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        return response()->json([
            'status' => true,
            'message' => 'user created',
            'data' => UserResource::make($user)
        ]);
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function update(User $user)
    {
        $attributes = (new UserValidator())->validate(
            $user,
            request()->all()
        );

        $attributes['password'] = Hash::make($attributes['password']);

        $user->update($attributes);

        return response()->json([
            'status' => true,
            'message' => 'user updated',
            'data' => UserResource::make($user)
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'user deleted'
        ]);
    }
}
