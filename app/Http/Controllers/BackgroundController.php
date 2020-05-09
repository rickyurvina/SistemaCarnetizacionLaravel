<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Http\Requests\BackgroundRequest;
use App\Models\Institution;
use Illuminate\Http\Request;
use Throwable;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $institutions=Background::WithInstitution()->get();
            $institution_id=$request->get('institution_id');
            $backgrounds=Background::Order()
                ->Institution($institution_id)
                ->paginate(5);
            return view('identification.backgrounds.index',
                compact('backgrounds','institutions'))
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
        try{
            $institutions=Institution::OrderCreate()->get();
            return view('identification.backgrounds.create',[
                'background'=>new Background(),
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
    public function store(BackgroundRequest $request)
    {
        //
        try{
            Background::create($request->validated());
            return redirect()
                ->route('background.index')
                ->with('info','Fondo registrado exitosamente');

        }catch(Throwable $e)
        {
            return back()
                ->with('info','Error: '.$e->getCode().' No se puede agregar, La institución '
                    .$request->institution_id.' ya tiene asociado un fondo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function show(Background $background)
    {
        try{
            return view('identification.backgrounds.show',[
                'background'=>$background,
            ]);

        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function edit(Background $background)
    {
        try{
            $institutions=Institution::OrderCreate()->get();
            return view('identification.backgrounds.edit',[
                'background'=>$background,
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
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function update(BackgroundRequest $request, Background $background)
    {
        try{
            $background->update( $request->validated());
            return redirect()
                ->route('background.show',$background)
                ->with('info','Fondo actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error'.$e->getCode().
                ' No se puede agregar, La institución '
                .$request->institution_id.' ya tiene asociado un fondo');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Background::findOrFail($id)->delete();
            return redirect()
                ->route('background.index')
                ->with('info','Fondo eliminado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }

    }
}
