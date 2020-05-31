<?php

namespace App\Http\Controllers;
use App\Http\Requests\CourseMessageRequest;
use App\Models\Course;
use App\Models\Institution;
use App\Models\Student;
use Throwable;

class CoursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth',['except'=>'byInstitution']);
        $this->middleware('roles:admin,representanteEducativa',['except'=>'byInstitution']);
    }
    /**
     * Funcion para cargar los cursos en el select de
     * estudiantes
     */
    public function byInstitution($id)
    {
        try{
            return Course::CourseIns($id)->get();
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    public function index()
    {
        try{
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->Type($type)->get();
            if (auth()->user()->isAdmin())
            {
                $courses=Course::with('institution')->Order()->CourseIns(request('institution_id'))->paginate(4);
            }elseif(auth()->user()->hasRoles(['representanteEducativa']))
            {
                $student=Student::Id(auth()->user()->cedula)->get('institution_id');
                foreach ($student as $stu) {
                    $ins_id=$stu->institution_id;
                }
                $courses=Course::with('institution')->where('institution_id',$ins_id)->paginate(15);
            }else{
                return back();
            }
            return view('identification.courses.index', compact('courses','institutions'))
                ->with('error','No se encontro esa institutcion');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
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
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->Type($type)->get();
            return view('identification.courses.create',[
                'course'=>new Course,
                'institution'=>$institutions
            ]);
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
    public function store(CourseMessageRequest $request)
    {
        try{
            Course::create($request->validated());
            return redirect()->route('course.index')->with('success','Curso registrado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        try{
             $students=Student::withCourseOrder($course->id)->get();
            return view('identification.courses.show',[
                'course'=>$course,
                'students'=>$students
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        try{
            $type='Institución Educativa';
            $institutions=Institution::OrderCreate()->Type($type)->get();
            return view('identification.courses.edit',[
                'course'=>$course,
                'institution'=>$institutions,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(CourseMessageRequest $request, $id)
    {
        try{
            $course=Course::findOrFail($id);
            $course->update( $request->validated() );
            return redirect()->route('course.show',$course)->with('success','Curso actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            Course::findOrFail($id)->delete();
            return redirect()->route('course.index')->with('delete','Curso eliminado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
}
