<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Course;
use App\Http\Requests\StudentRequest;
use App\Models\Institution;
use App\Models\Logo;
use App\Models\Picture;
use App\Models\Student;
use Illuminate\Support\Facades\Cache;
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
        $this->middleware('auth', ['except' => ['byInstitution', 'byStudent']]);
        $this->middleware('roles:admin,estudiante,representanteEducativa', ['except' => ['byInstitution', 'byStudent']]);
    }
    public function byInstitution($id)
    {
        try {
            return Student::where('institution_id', $id)->get();
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function byStudent($id)
    {
        try {
            return Student::where('id', $id)->get();
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function index()
    {
        try {
            $type = 'Institución Educativa';
            $institutions = Institution::OrderCreate()->type($type)->get();
            if (auth()->user()->isAdmin()) {
                $key = "students.page." . request('page', 1) . request('EST_CEDULA', null) . request('institution_id');;
                $students = Cache::remember($key, 180, function () {
                    return  Student::withInsCur()
                        ->OrderApellidos()->InstitutionId(request('institution_id'))->Id(request('EST_CEDULA'))->paginate(15);
                });
            } elseif (auth()->user()->hasRoles(['representanteEducativa'])) {
                $student = Student::StudentCedula(auth()->user()->cedula)->get('institution_id');
                foreach ($student as $stu) {
                    $institution_id = $stu->institution_id;
                    $students = Student::withInsCur()
                        ->OrderApellidos()->InstitutionId($institution_id)->Id(request('EST_CEDULA'))->paginate(15);
                }
            } else {
                return back();
            }
            return view('identification.students.index', compact('students', 'institutions'));
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            if (auth()->user()->isAdmin()) {
                $type = 'Institución Educativa';
                $institutions = Institution::OrderCreate()->type($type)->get();
                $courses = Course::PluckName();
                return view('identification.students.create', [
                    'student' => new Student,
                    'institution' => $institutions,
                    'course' => $courses,
                ]);
            } else {
                return back()->with('error', 'Error: Not Authorized.');
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
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
        try {
            Student::create($request->validated());
            Cache::flush();
            return redirect()
                ->route('student.index')
                ->with('success', 'Estudiante registrado exitosamente');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' Constraint violation. Registro Cédula: ' . $request->EST_CEDULA . ' o Correo Electronico: ' . $request->EST_CORREO . 'ya existen en la base de datos');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function carnet(Student $student)
    {
        $fondos=Background::where('institution_id',$student->institution_id)->get();
        $logos=Logo::where('institution_id',$student->institution_id)->get();
        $pictures=Picture::where('student_id',$student->id)->get();

        foreach ($logos as $logo) {
            $img_logo=$logo->LOG_NOMBRE;
        }

        $pdf = app('Fpdf');
// Aqui empiezo armar el pdf con fpdf entonces agregamos la pagina y los fondos del carnet.
        $pdf->AddPage();
        $pdf->SetFont('Arial');
// Fondos y Logos
        foreach ($fondos as $fondo) {
            $img_fondo=$fondo->FON_NOMBRE;
            $pdf->Image('images/BackgroundsPhotos/'.$img_fondo, 20, 30, 100, 80);
        }
//               $pdf->Image('images/LogosPhotos/'.$img_logo, 23, 32, 40, 17);
// Foto del estudiante
        foreach ($pictures as $picture) {
            $img_foto=$picture->nombre;
            $pdf->Image('images/StudentsPhotos/'.$img_foto, 23 ,50, 27 , 30);
        }
        // Aca el resto de los datos que necesitamos en el pdf los cuales ya nos hemos traido de la bd.
        $pdf->Ln(32);
        $pdf->SetFont('Arial','B',6);
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Nombre:'),0,0,'L');
        $pdf->Cell(66,4, utf8_decode($student->EST_NOMBRES.' '.$student->EST_APELLIDOS),0,1,'L');
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Identificacion: '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode($student->EST_CEDULA),0,1,'L');
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Fecha Nacimiento: '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode($student->EST_FECHANACIMIENTO),0,1,'L');
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Tipo Sangre: '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode($student->EST_TIPOSANGRE),0,1,'L');
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Curso: '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode('Curso del estudiante'),0,1,'L');
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Celular: '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode($student->EST_CELULAR),0,1,'L');
        $pdf->SetX(55); // Set 20 Eje Y
        $pdf->Cell(19,4, utf8_decode('Email: '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode($student->EST_CORREO),0,1,'L');
        $pdf->Ln(5);
        $pdf->SetX(22); // Set 20 Eje Y
        $pdf->Cell(55,4, utf8_decode('F. Emisión: 10/01/2018 '),0,0,'L');
        $pdf->Cell(66,4, utf8_decode('F. Vencimiento: 31/12/2018'),0,1,'L');
        $name='Carnet-Nro00';
//                $pdf->Output();
        //y aqui generamos el carnet.
        $pdf->Output('I',$name,true);
    }
    public function show(Student $student)
    {
        //
        try {
            $user = auth()->user();
            if ($user->can('show', $student)) {
                $student_id = $student->id;
                $picture = Picture::WithStudent($student_id);
                return view('identification.students.show', [
                    'student' => $student,
                    'picture' => $picture
                ]);
            } else {
                return back()->with('error', 'Error: Not Authorized.');
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
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
        try {
            $student = Student::findOrFail($id);
            $user = auth()->user();
            $type = 'Institución Educativa';
            $institutions = Institution::OrderCreate()->type($type)->get();
            $courses = Course::PluckName();
            if ($user->can('edit', $student)) {
                return view('identification.students.edit', [
                    'student' => $student,
                    'institution' => $institutions,
                    'course' => $courses,
                ]);
            } else {
                return back()->with('error', 'Error: Not Authorized.');
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        try {
            $user = auth()->user();
            $student = Student::findOrFail($id);
            if (auth()->user()->isAdmin()) {
                if ($user->can('update', $student)) {
                    $student->update($request->validated());
                    Cache::flush();
                    return redirect()
                        ->route('student.show', $student)->with('success', 'Estudiante actualizado exitosamente');
                } else {
                    return back()->with('error', 'Error: Not Authorized.');
                }
            } else {
                if ($user->can('update', $student)) {
                    $student->update($request->only('EST_CEDULA', 'EST_NOMBRES', 'EST_APELLIDOS', 'EST_SEXO', 'EST_FECHANACIMIENTO', 'EST_TIPOSANGRE', 'EST_DIRECCION', 'EST_NUMERO', 'EST_CELULAR', 'EST_CORREO'));
                    Cache::flush();
                    return redirect()
                        ->route('student.show', $student)->with('success', 'Estudiante actualizado exitosamente');
                } else {
                    return back()->with('error', 'Error: Not Authorized.');
                }
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' Constraint violation. Registro Cédula: ' . $request->EST_CEDULA . ' o Correo Electronico: ' . $request->EST_CORREO . ' ya existen en nuestros registros');
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
        try {
            Student::findOrFail($id)->delete();
            Cache::flush();
            return redirect()->route('student.index')->with('delete', 'Estudiante eliminado exitosamente');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
}
