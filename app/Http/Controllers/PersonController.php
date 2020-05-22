<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\PersonRequest;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Photo;
use Illuminate\Http\Request;
use Throwable;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth',['except'=>['byInstitution','byPerson']]);
        $this->middleware('roles:admin,usuario',['except'=>['byInstitution','byPerson']]);
    }
    public function byInstitution($id)
    {
        try{
            return Person::where('institution_id',$id)->get();
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    public function byPerson($id)
    {
        try{
            return Person::where('id',$id)->get();
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    public function index(Request $request)
    {
        try{
            $type='Organización';
            $person=$request->get('PER_CEDULA');
            $institutions=Institution::OrderCreate()->type($type)->get();
            $institution_id=$request->get('institution_id');
            $cedula_user=auth()->user()->cedula;
            if (auth()->user()->isAdmin())
            {
                if (!empty($institution_id))
                {
                    $people=Person::WithIns()->InstitutionId($institution_id)->paginate(count(Institution::get()));
                }
                else
                {
                    $people=Person::WithIns()->Id($person)->paginate(5);
                }
            }
            else{
                $people=Person::WithIns()->FindCedula($cedula_user)->paginate(1);
            }
            if (empty($people))
            {
                return view('identification.people.index', compact('people','institutions'));
            }
            else {
                return view('identification.people.index', compact('people', 'institutions'))
                    ->with('error', 'No se encontro esa persona');
            }
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
        try{
            if (auth()->user()->isAdmin())
            {
                $areas=Area::Nombre();
                $type='Organización';
                $institutions=Institution::OrderCreate()->type($type)->get();
                return view('identification.people.create',[
                    'person'=>new Person,
                    'institution'=>$institutions,
                    'area'=>$areas,
                ]);
            }else{
                return back()->with('error','Error: Not Authorized.');
            }
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        try{
            Person::create($request->validated());
            return redirect()
                ->route('person.index')->with('success','Usuario registrado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        try{
            $user=auth()->user();
            if ($user->can('show',$person))
            {
                $person_id=$person->id;
                $photo=Photo::WithPerson($person_id);
                return view('identification.people.show',[
                    'person'=>$person,
                    'photos'=>$photo
                ]);
            }else{
                return back()->with('error','Error: Not Authorized.');
            }
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        try{
            $type='Organización';
            $institutions=Institution::OrderCreate()->type($type)->get();
            $areas=Area::Nombre();
            $user=auth()->user();
            if ($user->can('edit',$person))
            {
                return view('identification.people.edit',[
                    'person'=>$person,
                    'institution'=>$institutions,
                    'area'=>$areas
                ]);
            }else{
                return back()->with('error','Error: Not Authorized.');
            }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        try{
            $user=auth()->user();
            if ($user->can('update',$person))
            {
                $person->update( $request->validated());
                return redirect()->route('person.show',$person)->with('success','Usuario actualizado exitosamente');
            }else{
                return back()->with('error','Error: Not Authorized.');
            }
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Person::findOrFail($id)->delete();
            return redirect()->route('person.index')->with('delete','Usuario eliminado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
}
