<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\TraitsUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use TraitsUser;
    public function index(Request $request)
    {
        $search = $this->SearchUserList([
            'filter'  => $request->query('filter')
        ]);
        return view('admin.user.index', [
            'filter' => $search['filter'],
            'users' => $search['users']
        ]);
    }

    public function add()
    {
        return view('admin.user.add');
    }
}
