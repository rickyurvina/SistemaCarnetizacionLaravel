<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
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
    public function index(Request $request  )
    {
        try{
            $name=$request->get('name');
            $users=User::orderBy('id','asc')
                ->where('name','LIKE',"%$name%")
                ->paginate(5);
            return view('identification.users.index',compact('users'));

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
            $user=new User;
            return view('identification.users.create',[
                'user'=>$user
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        try{
            User::create($request->validated());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try{
            $user=User::findOrFail($id);
//             $this->authorize($user);
            return view('identification.users.edit',[
                'user'=>$user
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
        //
//        return $request;
        try{
            $user=User::findOrFail($id);
            $user->update($request->all());
//            $id->update( $request->validated());
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
            User::findOrFail($id)->delete();
            return redirect()->route('user.index')
                ->with('delete','User eliminada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
                ' No se puede eliminar, contiene registros asociados');
        }
    }
}
