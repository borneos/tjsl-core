<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.user.index', [
            'users' => User::all()
        ]);
    }

    public function add()
    {
        return view('admin.user.add');
    }
}
