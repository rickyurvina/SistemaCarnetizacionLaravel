<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\PersonRequest;
use App\Institution;
use App\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $institutions=Institution::pluck('INS_NOMBRE','id');
        $institution_id=$request->get('institution_id');
        if (!empty($institution_id))
        {
            $people=Person::orderBy('created_at','DESC')
                ->where('institution_id',$institution_id)
                ->paginate(count(Institution::get()));
        }
        else
        {
            $people=Person::orderBy('created_at','DESC')
                ->paginate(5);
        }
        if (empty($people))
        {
            return view('identification.people.index', compact('people','institutions'));
        }
        return view('identification.people.index', compact('people','institutions'))->with('info','No se encontro esa persona');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas=Area::pluck('ARE_NOMBRE','id');
//        $institutions=Institution::pluck('INS_NOMBRE','id');
     $institutions=Institution::orderBy('INS_NOMBRE','ASC')
          ->where('INS_TIPO','=','Organización')->get();
        return view('identification.people.create',[
            'person'=>new Person,
            'institution'=>$institutions,
            'area'=>$areas,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        Person::create($request->validated());
        return redirect()
            ->route('person.index')
            ->with('info','Usuario registrado exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('identification.people.show',[
            'person'=>$person
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')
            ->where('INS_TIPO','=','Organización')->get();
        $areas=Area::pluck('ARE_NOMBRE','id');
        return view('identification.people.edit',[
            'person'=>$person,
            'institution'=>$institutions,
            'area'=>$areas
        ]);
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
        $person->update( $request->validated());
        return redirect()
            ->route('person.show',$person)
            ->with('info','Usuario actualizado exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::findOrFail($id)->delete();
        return redirect()->route('person.index')->with('info','Usuario eliminado exitosamente');
    }
}
