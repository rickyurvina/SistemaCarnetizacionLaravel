<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogoRequest;
use App\Institution;
use App\Logo;
use Illuminate\Http\Request;

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
        $institutions=Institution::pluck('INS_NOMBRE','id');
        $institution_id=$request->get('institution_id');
        if (!empty($institution_id))
        {
            $logos=Logo::orderBy('institution_id','DESC')
                ->where('institution_id',$institution_id)
                ->paginate(count(Institution::get()));
        }
        else{
            $logos=Logo::orderBy('institution_id','DESC')
                ->paginate(5);
        }
        if (empty($logos))
        {
            return view('identification.logos.index', compact('logos','institutions'));
        }
        return view('identification.logos.index', compact('logos','institutions'))
            ->with('info','No se encontro esa institutcion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')->get();
        return view('identification.logos.create',[
            'logo'=>new logo(),
            'institution'=>$institutions
        ]);
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
        logo::create($request->validated());
        return redirect()
            ->route('logo.index')
            ->with('info','Fondo registrado exitosamente');
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
        return view('identification.logos.show',[
            'logo'=>$logo,
        ]);
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
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')->get();
        return view('identification.logos.edit',[
            'logo'=>$logo,
            'institution'=>$institutions,
        ]);
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
        //
        $logo->update( $request->validated() );
        return redirect()
            ->route('logo.show',$logo)
            ->with('info','Fondo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        logo::findOrFail($id)->delete();
        return redirect()->route('logo.index')->with('info','Fondo eliminado exitosamente');

    }
}
