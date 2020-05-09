<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Models\Picture;
use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $students_id=$request->get('student_id');
            if (!empty($students_id))
            {
                $stu=Student::OrderCreated()->Id($students_id)->get('id');
                foreach($stu as $st){
                    $stu_id=$st->id;
                }
                $pictures=picture::Order()
                    ->Id($stu_id)
                    ->paginate(count(Student::get()));
            }
            else{
                $pictures=picture::orderBy('student_id','DESC')->paginate(5);
            }
            if (empty($pictures))
            {
                return view('identification.pictures.index', compact('pictures'));
            }
            return view('identification.pictures.index', compact('pictures'))
                ->with('info','No se encontro ese Estudiante');

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
            $students=student::Order()->get();
            return view('identification.pictures.create',[
                'picture'=>new picture(),
                'students'=>$students
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
    public function store(PictureRequest $request)
    {
        try{
            picture::create($request->validated());
            return redirect()
                ->route('picture.index')
                ->with('info','Foto registrada exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode().
                'No se puede agregar, El estudiante ya tiene una foto asociada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        try{
            return view('identification.pictures.show',[
                'picture'=>$picture,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
        try{
            $students=student::Order()->get();
            return view('identification.pictures.edit',[
                'picture'=>$picture,
                'students'=>$students,
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
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(PictureRequest $request, Picture $picture)
    {
        try{
            $picture->update( $request->validated() );
            return redirect()
                ->route('picture.show',$picture)
                ->with('info','Fondo actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode().
                'No se puede agregar, El estudiante ya tiene una foto asociada');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            picture::findOrFail($id)->delete();
            return redirect()->route('picture.index')
                ->with('info','Foto eliminado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }

    }
}
