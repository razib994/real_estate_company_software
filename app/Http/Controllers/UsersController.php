<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('user.view')) {
            abort(403, 'Unauthorized Access');
        }
        $users = User::all();
        return view('backend.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.users.create', compact('roles'));
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
            'name'      => 'required|max:50',
            'email'     => 'required|max:50|email|unique:users',
            'password'  => 'required|min:6|max:50|confirmed',

        ]);
        // Users Create
        $user = new User();
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->password   = Hash::make($request->password);
        $user->save();

        // Role Assigne
        if($request->roles){
            $user->assignRole($request->roles);
        }

        Session::flash('message', 'Users Created Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('backend.pages.users.edit', compact('user', 'roles'));
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
        // Users Create
        $user = User::find($id);
         $request->validate([
             'name'      => 'required|max:50',
             'email'     => 'required|max:50|email|unique:users,email,'.$id,
             'password'  => 'nullable|min:6|max:50|confirmed',

         ]);

        $user->name       = $request->name;
        $user->email      = $request->email;
        if($request->password){
            $user->password   = Hash::make($request->password);
        }
        $user->save();

        // Role Assigne
        $user->roles()->detach();
        if($request->roles){
            $user->assignRole($request->roles);
        }
        Session::flash('message', 'Users Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!is_null($user)) {
            $user->delete();
        }
        Session::flash('message', 'Users Deleted Successfully');
        return redirect('admin/users');
    }
}
