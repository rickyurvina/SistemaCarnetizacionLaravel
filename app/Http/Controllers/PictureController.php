<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Picture;
use App\Student;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $students=Student::pluck('EST_CEDULA','id');
        $students_id=$request->get('student_id');
        if (!empty($students_id))
        {
            $pictures=picture::orderBy('student_id','DESC')
                ->where('student_id',$students_id)
                ->paginate(count(Student::get()));
        }
        else{
            $pictures=picture::orderBy('student_id','DESC')
                ->paginate(5);
        }
        if (empty($pictures))
        {
            return view('identification.pictures.index', compact('pictures','students'));
        }
        return view('identification.pictures.index', compact('pictures','students'))
            ->with('info','No se encontro esa Estudiante');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $students=student::orderBy('EST_NOMBRES','ASC')->get();
        return view('identification.pictures.create',[
            'picture'=>new picture(),
            'students'=>$students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PictureRequest $request)
    {
        $id=$request->get('student_id');
        $student=Picture::with('student')
            ->where('student_id','=',$id)->get();
        if (count($student)<=0)
        {
            picture::create($request->validated());
            return redirect()
                ->route('picture.index')
                ->with('info','Foto registrada exitosamente');
        }
        else
        {
            return back()->with('info','No se puede agregar, El estudiante ya tiene una foto asociada');

        }

//             picture::create($request->validated());
//                return redirect()
//                    ->route('picture.index')
//                    ->with('info','Foto registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        //
        return view('identification.pictures.show',[
            'picture'=>$picture,
        ]);
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
        $students=student::orderBy('EST_NOMBRES','ASC')->get();
        return view('identification.pictures.edit',[
            'picture'=>$picture,
            'students'=>$students,
        ]);
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
        //
        $id=$request->get('student_id');
        $student=Picture::with('student')
            ->where('student_id','=',$id)->get();
        if (count($student)<=0)
        {
            $picture->update( $request->validated() );
            return redirect()
                ->route('picture.show',$picture)
                ->with('info','Fondo actualizado exitosamente');
        }
        else
        {
            return back()->with('info','No se puede agregar, El estudiante ya tiene una foto asociada');

        }
//        $picture->update( $request->validated() );
//        return redirect()
//            ->route('picture.show',$picture)
//            ->with('info','Fondo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        picture::findOrFail($id)->delete();
        return redirect()->route('picture.index')
            ->with('info','Foto eliminado exitosamente');

    }
}
