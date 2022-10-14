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

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        // dd($user->email);
        $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:users,email,' . $user->id
        ]);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => strlen($request->password) > 1 ? bcrypt($request->password) : $user->password
        ]);
        Alert::success('Success', 'Updated Successfully');
        return redirect()->route('admin.user.index');
    }
}
