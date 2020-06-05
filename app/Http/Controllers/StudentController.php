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
                    return Student::withInsCur()
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
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function carnet(Student $student)
    {
        $fondos = Background::where('institution_id', $student->institution_id)->get();
        $pictures = Picture::where('student_id', $student->id)->get();
        $institutions = Institution::where('id', $student->institution_id)->get();
        $courses = Course::where('institution_id', $student->institution_id)->get();
        $pdf = app('Fpdf');
        $pdf->SetMargins(1, 0, 0);
        $pdf->SetAutoPageBreak(true, 1);
        $pdf->AddPage('L', array(87, 55));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial');
        foreach ($fondos as $fondo) {
        }
        $pdf->Image('images/BackgroundsPhotos/' . $fondo->FON_NOMBRE, 0, 0.2, 87, 55);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 3);
        foreach ($pictures as $picture) {
        }
        $pdf->Image('images/StudentsPhotos/' . $picture->nombre, 62, 20, 20, 23.8);
        $pdf->SetY(16);
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetX(2.5); // Set $pdf->SetFont('Arial','B',7);20 Eje Y
        $pdf->Cell(15, 5, utf8_decode('Nombre:'), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Cell(10, 5, strtoupper($student->EST_NOMBRES . ' ' . $student->EST_APELLIDOS), 0, 1, 'L');
        /*CURSO Y PARALELO */
        $pdf->SetX(2.5); // Set 20 Eje Yç
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell(15, 5, utf8_decode('Año lectivo: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(10, 5, '2019-2020', 0, 1, 'L');
        $pdf->SetX(2.5); // Set 20 Eje Y
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell(15, 5, utf8_decode('Nivel: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 7);
        foreach ($courses as $course) {
        }
        $pdf->Cell(10, 5, utf8_decode($course->CUR_NOMBRE . ' ' . $course->CUR_PARALELO), 0, 1, 'L');
        $pdf->SetX(2.5); // Set 20 Eje Y
        $pdf->Cell(15, 1, utf8_decode(' '), 0, 1, 'L');
        $pdf->SetX(2.5); // Set 20 Eje Y
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell(15, 1, utf8_decode('Fecha '), 0, 1, 'L');
        $pdf->SetX(2.5); // Set 20 Eje Y
        $pdf->Cell(15, 5, utf8_decode('Nacimiento '), 0, 0, 'L');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fecha = strftime("%d de %B de %Y", strtotime($student->EST_FECHANACIMIENTO));
        $pdf->Cell(10, 5, utf8_decode($fecha), 0, 1, 'L');
        $pdf->SetX(2.5); // Set 20 Eje Y
        $pdf->Cell(15, 1, utf8_decode(' '), 0, 1, 'L');
        $pdf->SetX(2.5); // Set 20 Eje Y
        $pdf->SetFont('Arial', '', 5);
        $pdf->Cell(15, 5, utf8_decode('Tipo Sangre: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(10, 5, utf8_decode($student->EST_TIPOSANGRE), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 3);
        $pdf->SetXY(19, 51); // Set 20 Eje Y
        $pdf->Cell(28, 3, utf8_decode('Este carnet es de uso personal e instransferible, podrá ser utilizado únicamente por su titular'), 0, 0, 'L');
        /*carnet posterior*/
        $pdf->AddPage('L', array(87, 55));
        $pdf->SetFont('Arial');
        $pdf->Image('images/BackgroundsPhotos/' . $fondo->FON_NOMBRE2, 0, 0.2, 87, 55);
        $pdf->SetX(1); // Set $pdf->SetFont('Arial','B',7);20 Eje Y
        $pdf->SetY(13); // Set $pdf->SetFont('Arial','B',7);20 Eje Y
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(87,5, utf8_decode('MISIÓN'),0,1,'C');
        $pdf->SetFont('Arial','',6);
        foreach ($institutions as $institution) {
        }
        $pdf->MultiCell(87,3, utf8_decode($institution->INS_MISION),0,'C');
        $pdf->SetY(27.5); // Set $pdf->SetFont('Arial','B',7);20 Eje Y
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(87,5, utf8_decode('VISIÓN'),0,1,'C');
        $pdf->SetFont('Arial','',6);
        $pdf->MultiCell(87,3, utf8_decode($institution->INS_VISION),0,'C');
        $pdf->SetX(1); // Set 20 Eje Yç
        $name = 'Carnet-';
        $pdf->Output('I', $name, true);
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
     * @param \App\Student $student
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
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
     * @param \App\Student $student
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
