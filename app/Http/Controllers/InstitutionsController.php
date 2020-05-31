<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionMesageRequest;
use App\Models\Background;
use App\Models\Institution;
use App;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class InstitutionsController extends Controller
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

    public function index(Request $request)
    {
        try{
            $key="institutions.page.".request('page',1).request('institution_id',null).request('INS_NOMBRE',null);
            $institutions=Cache::remember($key,180,function (){
            $INS_NOMBRE=request('INS_NOMBRE');
            $type=request('institution_id');
                return Institution::OrderCreate()
                      ->Name($INS_NOMBRE)->Type($type)->paginate(4);
            });
            return view('identification.institutions.index',compact('institutions'));
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
            return view('identification.institutions.create',[
                'institution'=>new Institution
            ]);
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
    public function store(InstitutionMesageRequest $request)
    {
        try{
            Institution::create($request->validated());
            return redirect()->route('institution.index')->with('success','Institución registrada exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            $institution_id=$institution->id;
            $logo=Logo::WithInstitutionLogo($institution_id);
            $background=Background::WithInstitutionBack($institution_id);
            $courses=Institution::WithCourse()->CourseID($institution->id);
            return view('identification.institutions.show',[
                'institution'=>$institution,
                'courses'=>$courses,
                'logos'=>$logo,
                'backgrounds'=>$background
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionMesageRequest $request, $id)
    {
        try{
            $institution=Institution::findOrFail($id);
            $institution->update( $request->validated() );
            return redirect()
                ->route('institution.show',$institution)
                ->with('success','Institución actualizada exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            return redirect()->route('institution.index')->with('delete', 'Institución eliminada exitosamente');
        }catch(\Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
   }
}
