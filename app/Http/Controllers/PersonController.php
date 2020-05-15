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
        $this->middleware('auth');
        $this->middleware('roles:admin,usuario');
    }
    public function index(Request $request)
    {
        try{
            $type='Organización';
            $person=$request->get('PER_CEDULA');
            $institutions=Institution::OrderCreate()->type($type)->get();
            $institution_id=$request->get('institution_id');
            if (!empty($institution_id))
            {
                $people=Person::Order()->InstitutionId($institution_id)
                    ->paginate(count(Institution::get()));
            }
            else
            {
                $people=Person::Order()->Id($person)->paginate(5);
            }
            if (empty($people))
            {
                return view('identification.people.index',
                    compact('people','institutions'));
            }
            return view('identification.people.index',
                compact('people','institutions'))
                ->with('error','No se encontro esa persona');

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
        try{
            $areas=Area::Nombre();
            $type='Organización';
            $institutions=Institution::OrderCreate()->type($type)->get();
            return view('identification.people.create',[
                'person'=>new Person,
                'institution'=>$institutions,
                'area'=>$areas,
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
    public function store(PersonRequest $request)
    {
        try{
            Person::create($request->validated());
            return redirect()
                ->route('person.index')
                ->with('success','Usuario registrado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
            $person_id=$person->id;
            $photo=Photo::WithPerson($person_id);
            return view('identification.people.show',[
                'person'=>$person,
                'photos'=>$photo
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
            return view('identification.people.edit',[
                'person'=>$person,
                'institution'=>$institutions,
                'area'=>$areas
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
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        try{
            $person->update( $request->validated());
            return redirect()
                ->route('person.show',$person)
                ->with('success','Usuario actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
            return redirect()->route('person.index')
                ->with('delete','Usuario eliminado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }
}
