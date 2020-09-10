<?php

namespace App\Imports;

use App\Models\User;
use Hash;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function rules(): array
    {
        return [
            'email' => 'unique:users,email|email'
        ];


    }

    public function customValidationMessages()
    {
        return [
            'email.unique' => 'duplicate email here',
            'email.email' => 'must be email form'
        ];
    }

//    public function startRow(): int
//    {
//        return 2;
//    }

    public function model(array $row)
    {

        return new User([
            'id'     => $row['id'],
            'name'    => $row['name'],
            'email' => $row['email'],
            'date_of_birth' => $row['date_of_birth'],
            'gender' => $row['gender'],
            'password'=>Hash::make($row['password']),
            'type'=>$row['type']
        ]);
    }

    public function onFailure(Failure ...$failures)
    {

    }
}


