<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionMesageRequest;
use App\Models\Institution;
use App;
use Illuminate\Http\Request;
use Throwable;

class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIE(Request $request){
        try{
            $name='Educativa';
            $institutions=Institution::OrderCreate()
                ->Type($name)
                ->paginate(6);
            return view('identification.institutions.index',
                compact('institutions'));
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }

    }
    public function showO(Request $request){
        try{
            $name='Organización';
            $institutions=Institution::OrderCreate()
                ->Type($name)
                ->paginate(6);
            return view('identification.institutions.index',
                compact('institutions'));
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }

    }
    public function index(Request $request)
    {
        try{
            $INS_NOMBRE=$request->get('INS_NOMBRE');
            $institutions=Institution::OrderCreate()
                ->Name($INS_NOMBRE)
                ->paginate(6);
            return view('identification.institutions.index',compact('institutions'));

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
            return view('identification.institutions.create',[
                'institution'=>new Institution
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
    public function store(InstitutionMesageRequest $request)
    {
        try{
            Institution::create($request->validated());
            return redirect()
                ->route('institution.index')
                ->with('success','Institución registrada exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */

    public function show(Institution $institution)
    {
        try{
            $courses=Institution::WithCourse()
                ->CourseID($institution->id);
            return view('identification.institutions.show',[
                'institution'=>$institution,
                'courses'=>$courses
            ]);

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        try{
            return view('identification.institutions.edit',[
                'institution'=>$institution
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
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionMesageRequest $request, Institution $institution)
    {
        try{
            $institution->update( $request->validated() );
            return redirect()
                ->route('institution.show',$institution)
                ->with('success','Institución actualizada exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Institution::findOrFail($id)->delete();
            return redirect()->route('institution.index')
                ->with('delete', 'Institución eliminada exitosamente');
        }catch(\Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
                ' No se puede eliminar, contiene registros asignados');
        }
   }
}
