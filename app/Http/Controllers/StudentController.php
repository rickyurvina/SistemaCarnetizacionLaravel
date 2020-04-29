<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\StudentRequest;
use App\Institution;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $institutions=Institution::pluck('INS_NOMBRE','id');
        $student=$request->get('EST_CEDULA');
        $institution_id=$request->get('institution_id');
        if (!empty($institution_id))
        {
            $students=Student::orderBy('created_at','DESC')
                ->where('institution_id',$institution_id)
                ->paginate(count(Institution::get()));
        }
        else
        {
            $students=Student::orderBy('created_at','DESC')
                ->where('EST_CEDULA','LIKE',"%$student%")
                ->paginate(5);
        }
        if (empty($students))
        {
            return view('identification.students.index', compact('students','institutions'));
        }
        return view('identification.students.index', compact('students','institutions'))->with('info','No se encontro ese estudiante');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')
            ->where('INS_TIPO','=','Institución Educativa')->get();
        $courses=Course::pluck('CUR_NOMBRE','id');
//       $courses=Course::with('institution')
//           ->where('institution_id','=',$ins_id)->get();
        return view('identification.students.create',[
            'student'=>new Student,
            'institution'=>$institutions,
            'course'=>$courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        //
        Student::create($request->validated());
        return redirect()
            ->route('student.index')
            ->with('info','Estudiante registrado exitosamente');
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
        return view('identification.students.show',[
            'student'=>$student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')
            ->where('INS_TIPO','=','Institución Educativa')->get();
        $courses=Course::pluck('CUR_NOMBRE','id');
        return view('identification.students.edit',[
            'student'=>$student,
            'institution'=>$institutions,
            'course'=>$courses
        ]);
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
        //
        $student->update( $request->validated());
        return redirect()
            ->route('student.show',$student)
            ->with('info','Estudiante actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Student::findOrFail($id)->delete();
        return redirect()->route('student.index')->with('info','Estudiante eliminado exitosamente');
    }
}
