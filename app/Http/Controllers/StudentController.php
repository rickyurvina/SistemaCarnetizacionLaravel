<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StudentRequest;
use App\Models\Institution;
use App\Models\Picture;
use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;

class StudentController extends Controller
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
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->type($type)->get();
            $student=$request->get('EST_CEDULA');
            $institution_id=$request->get('institution_id');
            $cedula=auth()->user()->cedula;
            if (auth()->user()->isAdmin())
            {
                if (!Empty($institution_id)||!Empty($type)||!Empty($student))
                {
                    $students=Student::with(['institution','course'])
                        ->InstitutionId($institution_id)
                        ->Id($student)
                        ->paginate(count(Institution::get()));
                }else{
                    $students=Student::with(['institution','course'])
                        ->paginate(10);
                }
            }
            else{
                $students=Student::with(['institution','course'])
                    ->where('EST_CEDULA',$cedula)
                    ->paginate(1);
            }
            return view('identification.students.index',
                compact('students','institutions'))
                ->with('error','No se encontro ese estudiante');
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
    public function create(Request $request)
    {
        try{
           if (auth()->user()->isAdmin())
           {
               $type='Institución Educativa';
               $institutions=Institution::OrderCreate()->type($type)->get();
               $courses=Course::PluckName();
               return view('identification.students.create',[
                   'student'=>new Student,
                   'institution'=>$institutions,
                   'course'=>$courses,
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
    public function store(StudentRequest $request)
    {
        try{
            Student::create($request->validated());
            return redirect()
                ->route('student.index')
                ->with('success','Estudiante registrado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        try{
            $user=auth()->user();
            if ($user->can('show',$student))
            {
                $student_id=$student->id;
                $picture=Picture::WithStudent($student_id);
                return view('identification.students.show',[
                    'student'=>$student,
                    'picture'=>$picture
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          try{
            $student=Student::findOrFail($id);
             $user=auth()->user();
              $type='Institución Educativa';
              $institutions=Institution::OrderCreate()->type($type)->get();
              $courses=Course::PluckName();
             if ($user->can('edit',$student))
             {
                 return view('identification.students.edit',[
                     'student'=>$student,
                     'institution'=>$institutions,
                     'course'=>$courses,
                 ]);
             }else{
                 return back()->with('error','Error: Not Authorized.');
             }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        try{
            $user=auth()->user();
//            if (auth()->user()->isAdmin())
//            {
//                if ($user->can('update',$student))
//                {
//                    $student->update( $request->validated());
//                    return redirect()
//                        ->route('student.show',$student)
//                        ->with('success','Estudiante actualizado exitosamente');
//                }
//                else{
//                    return back()->with('error','Error: Not Authorized.');
//                }
//            }else{
                if ($user->can('update',$student))
                {
                    $student->update($request->only('EST_CEDULA','EST_NOMBRES','EST_APELLIDOS','EST_SEXO','EST_FECHANACIMIENTO','EST_TIPOSANGRE','EST_DIRECCION','EST_NUMERO','EST_CELULAR','EST_CORREO'));
                    return redirect()
                        ->route('student.show',$student)
                        ->with('success','Estudiante actualizado exitosamente');
                }
                else{
                    return back()->with('error','Error: Not Authorized.');
                }
//            }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Student::findOrFail($id)->delete();
            return redirect()->route('student.index')
                ->with('delete','Estudiante eliminado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }
}
