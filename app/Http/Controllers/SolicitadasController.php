<?php

namespace App\Http\Controllers;

use App\Models\Aprobadas;
use App\Models\Area;
use App\Models\Background;
use App\Models\Course;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Photo;
use App\Models\Picture;
use App\Models\Solicitadas;
use App\Models\Student;
use Illuminate\Http\Request;
use Throwable;

class SolicitadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin');
    }
    public function index()
    {
        try {
            $institutions = Institution::OrderCreate()->get();
            $solicitadas = Solicitadas::OrderCreate()->WhereInsId(request('institution_id'))->paginate(15);
            return view('identification.print.index', compact('solicitadas', 'institutions'))
                ->with('error', 'No se encuentran registros');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }


    public function show(Solicitadas $solicitada)
    {
        //
        try{
            if ($solicitada->tipo=='Estudiante')
            {
                $students=Student::where('EST_CEDULA',$solicitada->cedula)->get();
                foreach ($students as $student)
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
                    $pdf->Cell(15, 5, utf8_decode('Nacimiento: '), 0, 0, 'L');
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
            }else{
                $people=Person::where('PER_CEDULA',$solicitada->cedula)->get();
                foreach ($people as $person){
                }
                $fondos = Background::where('institution_id', $person->institution_id)->get();
                $photos = Photo::where('people_id', $person->id)->get();
                $institutions = Institution::CourseID($person->institution_id);
                $areas = Area::where('id',$person->area_id)->get('ARE_NOMBRE');
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
                foreach ($photos as $photo) {
                }
                $pdf->Image('images/PeoplePhotos/' . $photo->nombre, 62, 20, 20, 23.8);
                $pdf->SetY(16);
                $pdf->SetFont('Arial', '', 5);
                $pdf->SetX(2.5); // Set $pdf->SetFont('Arial','B',7);20 Eje Y
                $pdf->Cell(15, 5, utf8_decode('Nombre:'), 0, 0, 'L');
                $pdf->SetFont('Arial', 'B', 6);
                $pdf->Cell(10, 5, strtoupper($person->PER_NOMBRES . ' ' . $person->PER_APELLIDOS), 0, 1, 'L');
                /*CURSO Y PARALELO */
                $pdf->SetX(2.5); // Set 20 Eje Yç
                $pdf->SetFont('Arial', '', 5);
                $pdf->Cell(15, 5, utf8_decode('Ceduka: '), 0, 0, 'L');
                $pdf->SetFont('Arial', '', 7);
                $pdf->Cell(10, 5, $person->PER_CEDULA, 0, 1, 'L');
                $pdf->SetX(2.5); // Set 20 Eje Y
                $pdf->SetFont('Arial', '', 5);
                $pdf->Cell(15, 5, utf8_decode('Area: '), 0, 0, 'L');
                $pdf->SetFont('Arial', '', 7);
                foreach ($areas as $area) {
                }
                $pdf->Cell(10, 5, utf8_decode($area->ARE_NOMBRE), 0, 1, 'L');
                $pdf->SetX(2.5); // Set 20 Eje Y
                $pdf->Cell(15, 1, utf8_decode(' '), 0, 1, 'L');
                $pdf->SetX(2.5); // Set 20 Eje Y
                $pdf->SetFont('Arial', '', 5);
                $pdf->Cell(15, 1, utf8_decode('Fecha '), 0, 1, 'L');
                $pdf->SetX(2.5); // Set 20 Eje Y
                $pdf->Cell(15, 5, utf8_decode('Nacimiento '), 0, 0, 'L');
                setlocale(LC_TIME, 'es_ES.UTF-8');
                setlocale(LC_TIME, 'es_ES.UTF-8');
                $fecha = strftime("%d de %B de %Y", strtotime($person->PER_FECHANACIMIENTO));
                $pdf->Cell(10, 5, utf8_decode($fecha), 0, 1, 'L');
                $pdf->SetX(2.5); // Set 20 Eje Y
                $pdf->Cell(15, 1, utf8_decode(' '), 0, 1, 'L');
                $pdf->SetX(2.5); // Set 20 Eje Y
                $pdf->SetFont('Arial', '', 5);
                $pdf->Cell(15, 5, utf8_decode('Tipo Sangre: '), 0, 0, 'L');
                $pdf->SetFont('Arial', '', 7);
                $pdf->Cell(10, 5, utf8_decode($person->PER_TIPOSANGRE), 0, 1, 'L');
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
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $solicitada=Solicitadas::findOrFail($id);
        $aprobadas = new Aprobadas();
        $aprobadas->solicitadas_id = $solicitada->id;
        $aprobadas->institution_id = $solicitada->institution_id;
        $aprobadas->save();
        return back()->with('success','Aprobada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitadas  $solicitadas
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        try {
            Solicitadas::findOrFail($id)->delete();
            return redirect()->route('solicitadas.index')->with('delete', 'Solicitud impresa');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
}
