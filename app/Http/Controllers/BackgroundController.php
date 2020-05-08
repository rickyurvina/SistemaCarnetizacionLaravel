<?php

namespace App\Http\Controllers;

use App\Background;
use App\Http\Requests\BackgroundRequest;
use App\Institution;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $institutions=Background::with('institution')->get();
        $institution_id=$request->get('institution_id');
        if (!empty($institution_id))
        {
            $backgrounds=Background::orderBy('institution_id','DESC')
                ->where('institution_id',$institution_id)
                ->paginate(count(Institution::get()));
        }
        else{
            $backgrounds=Background::orderBy('institution_id','DESC')
                ->paginate(5);
        }
        if (empty($backgrounds))
        {
            return view('identification.backgrounds.index', compact('backgrounds','institutions'));
        }
        return view('identification.backgrounds.index', compact('backgrounds','institutions'))->with('info','No se encontro esa institutcion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')->get();
        return view('identification.backgrounds.create',[
            'background'=>new Background(),
            'institution'=>$institutions
        ]);
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
       $id=$request->get('institution_id');
//     $institution_id=Background::orderBy('id','ASC')
//           ->where('institution_id',$id)->get('institution_id');
    $ins=Background::with('institution')
        ->where('institution_id','=',$id)->get();
        if (count($ins)<=0){
            Background::create($request->validated());
            return redirect()
                ->route('background.index')
                ->with('info','Fondo registrado exitosamente');
        }
        else{
            return back()->with('info','No se puede agregar, La institución ya tiene asociado un fondo');
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
        //
        return view('identification.backgrounds.show',[
            'background'=>$background,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function edit(Background $background)
    {
        //
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')->get();
        return view('identification.backgrounds.edit',[
            'background'=>$background,
            'institution'=>$institutions,
        ]);
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
        $id=$request->get('institution_id');
        $institution_id=Background::orderBy('id','ASC')
            ->where('institution_id',$id)->get('institution_id');
        $ins=Background::with('institution')
            ->where('institution_id','=',$id)->get();

        if (count($ins)<=0){
            $background->update( $request->validated() );
            return redirect()
                ->route('background.show',$background)
                ->with('info','Fondo actualizado exitosamente');
        }
        else{
            return back()->with('info','No se puede agregar, La institución ya tiene asociado un fondo');
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
        //
        Background::findOrFail($id)->delete();
        return redirect()->route('background.index')->with('info','Fondo eliminado exitosamente');

    }
}
