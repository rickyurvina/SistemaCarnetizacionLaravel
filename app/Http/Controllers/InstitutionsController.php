<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMesageRequest;
use App\Institution;
use Illuminate\Http\Request;

class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions=Institution::paginate(10);
        return view('identification.institutions.educational.index_educational',[
            'institutions'=>Institution::paginate()
        ]);
        //return view('identification.institutions.educational.index_educational');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('identification.institutions.educational.create',[
            'institution'=>new Institution
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMesageRequest $request)
    {
        Institution::create($request->validated());
        return redirect()
            ->route('institution.index')
            ->with('info','Institucion registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {

        return view('identification.institutions.educational.show',[
            'institution'=>$institution
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        return view('identification.institutions.educational.edit',[
            'institution'=>$institution
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMesageRequest $request, Institution $institution)
    {
        //
        $institution->update( $request->validated() );
        return redirect()
            ->route('institution.show',$institution)
            ->with('status','El Proyecto Fue actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();
        return redirect()->route('institution.index');
    }
}
