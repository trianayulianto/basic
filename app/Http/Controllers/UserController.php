<?php

namespace App\Http\Controllers;

use \App\User;
use App\Http\Resources\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Users(User::all());
        // $data['row'] = User::all();
        // foreach ($data['row'] as $key => $value) {
        //     $data['row'][$key]->role = User::find($value->id)->roles;
        // }
        // return response()->json($data['row'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);
        if ($user) {
            if ($request->has('role') && !empty($request->role)) {
                $user->roles()->sync($request->role);
            }else {
                $user->roles()->attach(['role_id' => 2]); // regiter hanya untuk member
            }
        }
        return response()->json(['success' => 'Berhasil mendaftar!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = User::find($id);
        $data['row']->roles;
        return response()->json($data['row'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $password = !empty($request->password) ? bcrypt($request->password) : $user->password;
        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $password
        ]);
        if ($request->has('role') && !empty($request->role)) {
            $user->roles()->sync($request->role);
        }
        return response()->json(['success' => 'Data berhasil diperbaharui.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus.'], 200);
    }
}
