<?php

namespace App\Http\Controllers;

use App\Models\Solicitadas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SolicitadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
//        $solicitadas=DB::table('solicitadas')->insert([
//            'user_id'=>auth()->user()->id,
//        ]);
//        try{
//            return $user_id=auth()->user()->id;
//            $solicitadas=new Solicitadas();
//            $solicitadas->user_id=auth()->user()->id;
//            $solicitadas->numero_solicitudes=1;
//            $solicitadas->save();
//            return back()->with('success','Solicitud realizada');
//        }catch(Throwable $e){
//            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
//        }
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
    public function destroy(Solicitadas $solicitadas)
    {
        //
    }
}
