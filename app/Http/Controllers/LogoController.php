<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogoRequest;
use App\Models\Institution;
use App\Models\Logo;
use Illuminate\Http\Request;
use Throwable;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try{
            $institutions=logo::WithInstitution();
            $institution_id=$request->get('institution_id');
            $logos=Logo::Order()
                ->InstitutionId($institution_id)
                ->paginate(5);
            return view('identification.logos.index',
                compact('logos','institutions'))
                ->with('info','No se encontro esa institutcion');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
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
            $institutions=Institution::OrderCreate()->get();
            return view('identification.logos.create',[
                'logo'=>new logo(),
                'institution'=>$institutions
            ]);
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogoRequest $request)
    {
        //
        try{
            logo::create($request->validated());
            return redirect()
                ->route('logo.index')
                ->with('info','Fondo registrado exitosamente');
        }catch(Throwable $e){
            return back()->with('info','Error'.$e->getCode().' No se puede agregar, La institución  '
                .$request->institution_id.' ya tiene asociado un logo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        //
        try{
            return view('identification.logos.show',[
                'logo'=>$logo,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        //
        try{
            $institutions=Institution::orderBy('INS_NOMBRE','ASC')->get();
            return view('identification.logos.edit',[
                'logo'=>$logo,
                'institution'=>$institutions,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(LogoRequest $request, Logo $logo)
    {
        try{
            $logo->update( $request->validated() );
            return redirect()
                ->route('logo.show',$logo)
                ->with('info','Fondo actualizado exitosamente');
        }catch(Throwable $e){
            return back()->with('info','Error: '.$e->getCode().' No se puede agregar, La institución  '
                .$request->institution_id.' ya tiene asociado un logo');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            logo::findOrFail($id)->delete();
            return redirect()->route('logo.index')
                ->with('info','Fondo eliminado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }
}
