<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\AreaRequest;
use Illuminate\Http\Request;
use Throwable;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $ARE_NOMBRE=$request->get('ARE_NOMBRE');
            $areas=Area::orderBy('ARE_NOMBRE','ASC')
                ->name($ARE_NOMBRE)
                ->paginate(6);
            return view('identification.areas.index',compact('areas'));

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
            return view('identification.areas.create',[
                'area'=>new Area
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
    public function store(AreaRequest $request)
    {
        try{
            Area::create($request->validated());
            return redirect()
                ->route('area.index')
                ->with('info','Area registrada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        try{
            return view('identification.areas.show',[
                'area'=>$area
            ]);
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        try{
            return view('identification.areas.edit',[
                'area'=>$area
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
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, Area $area)
    {
        try{
            $area->update( $request->validated() );
            return redirect()
                ->route('area.show',$area)
                ->with('info','Area actualizada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Area::findOrFail($id)->delete();
            return redirect()->route('area.index')
                ->with('info','Area eliminada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }
}
