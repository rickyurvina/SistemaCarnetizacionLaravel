<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Solicitadas;
use Illuminate\Http\Request;
use Throwable;

class SolicitadasController extends Controller
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
            $institution_id=$request->get('institution_id');
            $institutions=Institution::orderBy('INS_NOMBRE','asc')->get();
            if (!empty($institution_id))
            {
                $solicitadas=Solicitadas::orderBy('created_at','asc')
                    ->where('institution_id',$institution_id)->paginate(count(Institution::get()));
            }else{
                $solicitadas=Solicitadas::orderBy('created_at','asc')->paginate(10);
            }
            return view('identification.print.index',compact('solicitadas','institutions'))
                ->with('error' ,'No se encuentran registros');
        }catch(Throwable $e){
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitadas $solicitadas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitadas $solicitadas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitadas $solicitadas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            Solicitadas::findOrFail($id)->delete();
            return redirect()->route('solicitadas.index')->with('delete','Solicitud eliminada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
}
