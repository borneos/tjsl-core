<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\TraitsUser;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.user.index');
    }
}
