<?php

namespace App\Models\Validators;

use App\Models\User;
use Illuminate\Validation\Rule;

class UserValidator {
    public function validate(User $user, array $attributes)
    {
        return validator($attributes, [
            'name' => 'required',
            'age' => 'required',
            'username' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'min:8', 'confirmed'],
        ])->validate();
    }
}
