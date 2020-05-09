<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StudentRequest;
use App\Models\Institution;
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
    public function index(Request $request)
    {
        try{
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->type($type)->get();
            $student=$request->get('EST_CEDULA');
            $institution_id=$request->get('institution_id');
            $students=Student::OrderCreated()
                ->InstitutionId($institution_id)
                ->Id($student)
                ->paginate(10);
            return view('identification.students.index',
                compact('students','institutions'))
                ->with('info','No se encontro ese estudiante');

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
    public function create(Request $request)
    {
        try{
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->type($type)->get();
            $courses=Course::PluckName();
            return view('identification.students.create',[
                'student'=>new Student,
                'institution'=>$institutions,
                'course'=>$courses,
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
    public function store(StudentRequest $request)
    {
        try{
            Student::create($request->validated());
            return redirect()
                ->route('student.index')
                ->with('info','Estudiante registrado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
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
            return view('identification.students.show',[
                'student'=>$student
            ]);
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
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
        try{
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->type($type)->get();
            $courses=Course::PluckName();
            return view('identification.students.edit',[
                'student'=>$student,
                'institution'=>$institutions,
                'course'=>$courses,
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        try{
            $student->update( $request->validated());
            return redirect()
                ->route('student.show',$student)
                ->with('info','Estudiante actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
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
                ->with('info','Estudiante eliminado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('info','Error: '.$e->getCode());
        }
    }
}
