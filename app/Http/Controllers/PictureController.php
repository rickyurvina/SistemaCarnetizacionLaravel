<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Models\Picture;
use App\Models\Student;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Throwable;


class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin,estudiante');
    }
    public function index(Request $request)
    {
        try{
            $students_id=$request->get('student_id');
            if (auth()->user()->isAdmin())
            {
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
                    $pictures=picture::with('student')->paginate(5);
                }
            }
            else{
                $cedula_usuario=auth()->user()->cedula;
               $students=Student::where('EST_CEDULA',$cedula_usuario)->get('id');
                foreach ($students as $student) {
                    $id_estudiante=$student->id;
               }
                $pictures=Picture::with('student')
                    ->where('student_id',$id_estudiante)->paginate(1);
                return view('identification.pictures.index', compact('pictures'));
            }
            if (empty($pictures))
            {
                return view('identification.pictures.index', compact('pictures'));
            }
            return view('identification.pictures.index', compact('pictures'))
                ->with('error','No se encontro  Estudiante');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
           if (auth()->user()->isAdmin())
           {
               $students=student::Order()->get();
               return view('identification.pictures.create',[
                   'picture'=>new picture(),
                   'students'=>$students
               ]);
           }
           else{
               return back()->with('error','Error: Not Authorized.');
           }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            if (!$request->nombre)
            {
                return back()->with('error','No selecciono ninguna imagen');
            }
            else{
                $post= picture::create($request->validated());

                if ($request->hasFile('nombre'))
                {
                    $extension=$request->file('nombre')->getClientOriginalExtension();
                    $student_id=$request->student_id;
                    $cedula=Student::WithPicture($student_id);
                    foreach ($cedula as $ced)
                    {
                        $cedula_stu=$ced->EST_CEDULA;
                    }
                    $file_name=$cedula_stu.'.'.$extension;
                    Image::make($request->file('nombre'))
                        ->resize(375,508)
                        ->save('images/StudentsPhotos/'.$file_name);
                    $post->nombre=$file_name;
                    $post->save();
                }
                return redirect()
                    ->route('picture.index')
                    ->with('success','Foto registrada exitosamente');
            }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
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
            return back()->with('error','Error: '.$e->getCode());
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
        $student_id=$picture->student_id;
        $user=auth()->user();
        try{
            $students=student::StudentID($student_id);
            $student=Student::findOrFaIL($student_id);
            if ($user->can('edit',$student))
            {
                return view('identification.pictures.edit',[
                    'picture'=>$picture,
                    'students'=>$students,
                ]);
            }
            else{
                return back()->with('error','Error: Not Authorized.');
            }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
        try
        {
            $student_id=$picture->student_id;
            $user=auth()->user();
            $post=Picture::find($picture->id);
            $student=Student::findOrFaIL($student_id);
            if ($user->can('update',$student))
            {
                $post->fill($request->validated())->save();
                if ($request->hasFile('nombre'))
                {
                    $extension=$request->file('nombre')->getClientOriginalExtension();
                    $student_id=$request->student_id;
                    $cedula=Student::WithPicture($student_id);
                    foreach ($cedula as $ced)
                    {
                        $cedula_stu=$ced->EST_CEDULA;
                    }
                    $file_name=$cedula_stu.'.'.$extension;
                    Image::make($request->file('nombre'))
                        ->resize(375,508)
                        ->save('images/StudentsPhotos/'.$file_name);
                    $post->nombre=$file_name;
                    $post->save();
                }
                return redirect()
                    ->route('picture.show',$picture)
                    ->with('success','Foto actualizado exitosamente');
            }else{
                return back()->with('error','Error: Not Authorized.');
            }
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
                'No se puede modificar, El estudiante ya tiene una foto asociada');
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
                ->with('delete','Foto eliminado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }

    }
}
