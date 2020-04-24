<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\AreaRequest;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ARE_NOMBRE=$request->get('ARE_NOMBRE');
        $areas=Area::orderBy('ARE_NOMBRE','ASC')
            ->where('ARE_NOMBRE','LIKE',"%$ARE_NOMBRE%")
            ->paginate(6);
        return view('identification.areas.index',compact('areas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('identification.areas.create',[
            'area'=>new Area
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        Area::create($request->validated());
        return redirect()
            ->route('area.index')
            ->with('info','Area registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
        return view('identification.areas.show',[
            'area'=>$area
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
        return view('identification.areas.edit',[
            'area'=>$area
        ]);
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
        //
        $area->update( $request->validated() );
        return redirect()
            ->route('area.show',$area)
            ->with('info','Area actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Area::findOrFail($id)->delete();
        return redirect()->route('area.index')->with('info','Area eliminada exitosamente');

    }
}