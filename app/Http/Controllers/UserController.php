<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\admin\AddUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $username = $request->input('username');
        $password = bcrypt($request->input('password')) ;
        $email = $request->input('email');
        $name = $request->input('name');
        $role = $request->input('role');

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->name = $name;
        $user->role = $role;

        $user->save();
        return redirect()->back()->with('msg', 'Thêm người dùng thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.user.show')->with(compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $username = $request->input('username');
        $password = $request->input('password') ;
        $email = $request->input('email');
        $name = $request->input('name');
        $role = $request->input('role');

        $user = User::find($id);
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->name = $name;
        $user->role = $role;

        $user->save();
        return redirect()->back()->with('msg', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $user->delete();
        return redirect()->back()-> with('msg', "Xoá thành công người dùng");
    }
}
