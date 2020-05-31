<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Student;
use App\Role;
use App\User;
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
        $this->middleware('roles:admin');

    }
    public function index()
    {
        try{
            $users=User::WithRoles()->Name(request('name'))->paginate(15);
            return view('identification.users.index',compact('users'));
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            $type='Ins';
            $type2='Org';
            $institution_educative=Institution::OrderCreate()->type($type)->get();
            $organisation=Institution::OrderCreate()->type($type2)->get();
            $student=Student::OrderApellidos()->get();
            $person=Person::OrderApellidos()->get();
            $roles=Role::PluckDisplayName();
            $user=new User;
            return view('identification.users.create',[
                'user'=>$user,
                'roles'=>$roles,
                'institution'=>$institution_educative,
                'institutions'=>$organisation,
                'student'=>$student,
                'people'=>$person
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
        try{
            $user=User::create($request->validated());
            $user->roles()->attach($request->roles);
            return redirect()->route('user.index')->with('success','Usuario registrada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
        try{
            return view('identification.users.show',[
                'user'=>$user
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            $type='Ins';
            $type2='Org';
            $institution_educative=Institution::OrderCreate()->type($type)->get();
            $organisation=Institution::OrderCreate()->type($type2)->get();
            $student=Student::OrderApellidos()->get();
            $person=Person::OrderApellidos()->get();
             $user=User::findOrFail($id);
             $this->authorize($user);
             $roles=Role::PluckDisplayName();
            return view('identification.users.edit',[
                'user'=>$user,
                'roles'=>$roles,
                'institution'=>$institution_educative,
                'institutions'=>$organisation,
                'student'=>$student,
                'people'=>$person
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
            $user->update($request->only('email','name','cedula'));
            $user->roles()->sync($request->roles);
            return redirect()->route('user.index')->with('success','User actualizada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            return redirect()->route('user.index')->with('delete','User eliminada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
}
