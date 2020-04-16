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
    public function index(Request $request)
    {
        $INS_NOMBRE=$request->get('INS_NOMBRE');
        $institutions=Institution::latest('created_at')
            ->where('INS_NOMBRE','LIKE',"%$INS_NOMBRE%")
            ->paginate(4);

        return view('identification.institutions.educational.index_educational',compact('institutions'));


//        $institutions=Institution::latest('created_at')
//        ->name($name);
//        return view('identification.institutions.educational.index_educational',[
//            'institutions'=>Institution::paginate(5)
//        ]);
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
//        dd($request);
        Institution::create($request->validated());
        return redirect()
            ->route('institution.index')
            ->with('info','Institución registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
//        $institution=Institution::findOrFail($institution);
//        return view('identification.institutions.educational.show',compact('institutions'));

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
            ->with('info','Institución actualizada exitosamente');
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
