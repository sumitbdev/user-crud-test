<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        $users = User::orderBy('id','desc')->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('users.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        User::create($request->post());

        return redirect()->route('users.index')->with('success','User has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\User  $User
    * @return \Illuminate\Http\Response
    */
    public function show(User $User)
    {
        return view('users.show',compact('User'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\User  $User
    * @return \Illuminate\Http\Response
    */
    public function edit(User $User)
    {
        return view('users.edit',compact('User'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\User  $User
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $User)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        $User->fill($request->post())->save();

        return redirect()->route('users.index')->with('success','User Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\User  $User
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $User)
    {
        $User->delete();
        return redirect()->route('users.index')->with('success','User has been deleted successfully');
    }
}