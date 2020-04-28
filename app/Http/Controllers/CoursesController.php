<?php

namespace App\Http\Controllers;
use App\Http\Requests\CourseMessageRequest;
use App\Course;
use App\Institution;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $institutions=Institution::pluck('INS_NOMBRE','id');
        $institution_id=$request->get('institution_id');
        if (!empty($institution_id))
        {
            $courses=Course::orderBy('institution_id','DESC')
                ->where('institution_id',$institution_id)
                ->paginate(count(Institution::get()));
        }
        else{
            $courses=Course::orderBy('institution_id','DESC')
                ->paginate(5);
        }
        if (empty($courses))
        {
            return view('identification.courses.index', compact('courses','institutions'));
        }
        return view('identification.courses.index', compact('courses','institutions'))->with('info','No se encontro esa institutcion');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $institutions=Institution::pluck('INS_NOMBRE','id');
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')
            ->where('INS_TIPO','=','Institución Educativa')->get();
        return view('identification.courses.create',[
            'course'=>new Course,
            'institution'=>$institutions
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseMessageRequest $request)
    {
        Course::create($request->validated());
        return redirect()
            ->route('course.index')
            ->with('info','Curso registrado exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
        return view('identification.courses.show',[
            'course'=>$course
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
     //  $course=Course::findOrFail($course);
        $institutions=Institution::orderBy('INS_NOMBRE','ASC')
            ->where('INS_TIPO','=','Organización')->get();
        return view('identification.courses.edit',[
            'course'=>$course,
            'institution'=>$institutions
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(CourseMessageRequest $request, Course $course)
    {
//     return $request;
        $course->update( $request->validated() );
        return redirect()
            ->route('course.show',$course)
            ->with('info','Curso actualizado exitosamente');
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
        Course::findOrFail($id)->delete();
        return redirect()->route('course.index')->with('info','Curso eliminado exitosamente');

    }
}
