<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Auth,Hash;

class authenticateUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */



    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $currentPassword)
    {
        //$currentPassword = $this->input('old_password');
            if (!Hash::check($currentPassword, Auth()->user()->password)){
                return false;
            }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ein unrichtiges altes Passwort.';
    }
}
