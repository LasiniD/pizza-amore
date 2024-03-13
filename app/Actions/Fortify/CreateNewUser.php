<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'dob'=>['required','date'],
            'address'=>['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tel'=>['required','string','max:15'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'dob'=>$input['dob'],
            'address'=>$input['address'],
            'email' => $input['email'],
            'tel'=>$input['tel'],
            'password' => Hash::make($input['password']),
        ]);
    }
}