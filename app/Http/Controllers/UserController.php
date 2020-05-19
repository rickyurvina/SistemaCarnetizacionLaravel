<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin,usuario',['except'=>['edit','show','update','destroy']]);

    }
    public function index(Request $request  )
    {
        try{
//            $ci=auth()->user()->cedula;
            $name=$request->get('name');
            $users=User::with('roles')
                ->where('name','LIKE',"%$name%")
//                ->where('cedula',$ci)
                ->paginate(5);
            return view('identification.users.index',compact('users'));

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try{
            $roles=Role::pluck('display_name','id');
            $user=new User;
            return view('identification.users.create',[
                'user'=>$user,
                'roles'=>$roles
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RegisterUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUserRequest $request)
    {
        //

        try{
            $user=User::create($request->validated());
            $user->roles()->attach($request->roles);

            return redirect()
                ->route('user.index')
                ->with('success','Usuario registrada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        try{
            return view('identification.users.show',[
                'user'=>$user
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        try{
            $user=User::findOrFail($id);
             $this->authorize($user);
             $roles=Role::pluck('display_name','id');
            return view('identification.users.edit',[
                'user'=>$user,
                'roles'=>$roles
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        try{
            $user=User::findOrFail($id);
            $this->authorize($user);
            $user->update($request->only('email','name','cedula'));
            $user->roles()->sync($request->roles);
            return redirect()
                ->route('user.show',$id)
                ->with('success','User actualizada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
           $user= User::findOrFail($id)->delete();
            $this->authorize($user);
            return redirect()->route('user.index')
                ->with('delete','User eliminada exitosamente');
        }catch(Throwable $e)
        {
            return back();
        }
    }
}
