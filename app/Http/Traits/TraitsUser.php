<?php

namespace App\Http\Traits;

use App\Models\User;

trait TraitsUser
{
    public function SearchUserList($data)
    {
        $filter = $data['filter'];

        if ($filter == null) {
            $users = User::all();

            return compact('users', 'filter');
        } else {
            $users = User::where('users.name', 'like', '%' . $filter . '%')
                ->orWhere('users.email', 'like', '%' . $filter . '%')->get();

            return compact('users', 'filter');
        }
    }
}
