<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\PersonRequest;
use App\Models\Background;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Photo;
use Throwable;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth', ['except' => ['byInstitution', 'byPerson']]);
        $this->middleware('roles:admin,usuario,representanteOrganizacion', ['except' => ['byInstitution', 'byPerson']]);
    }
    public function byInstitution($id)
    {
        try {
            return Person::where('institution_id', $id)->get();
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function byPerson($id)
    {
        try {
            return Person::where('id', $id)->get();
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function index()
    {
        try {
            $type = 'Organización';
            $institutions = Institution::OrderCreate()->type($type)->get();
            $cedula_user = auth()->user()->cedula;
            if (auth()->user()->isAdmin()) {
                $people = Person::WithIns()->OrderApellidos()->InstitutionId(request('institution_id'))->Id(request('PER_CEDULA'))->paginate(15);
            } elseif (auth()->user()->hasRoles(['representanteOrganizacion'])) {
                $usuario = Person::FindCedula($cedula_user)->get('institution_id');
                foreach ($usuario as $usu) {
                    $ins_id = $usu->institution_id;
                }
                $people = Person::OrderApellidos()->InstitutionId($ins_id)->paginate(15);
            } else {
                return back();
            }
            if (empty($people)) {
                return view('identification.people.index', compact('people', 'institutions'));
            } else {
                return view('identification.people.index', compact('people', 'institutions'))
                    ->with('error', 'No se encontro esa persona');
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function carnet(Person $person)
    {
        try{
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
        try {
            if (auth()->user()->isAdmin()) {
                $areas = Area::Nombre();
                $type = 'Organización';
                $institutions = Institution::OrderCreate()->type($type)->get();
                return view('identification.people.create', [
                    'person' => new Person,
                    'institution' => $institutions,
                    'area' => $areas,
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
    public function store(PersonRequest $request)
    {
        try { //
            Person::create($request->validated());
            return redirect()
                ->route('person.index')->with('success', 'Usuario registrado exitosamente');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        try {
            $user = auth()->user();
            if ($user->can('show', $person)) {
                $person_id = $person->id;
                $photo = Photo::WithPerson($person_id);
                return view('identification.people.show', [
                    'person' => $person,
                    'photos' => $photo
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
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        try {
            $type = 'Organización';
            $institutions = Institution::OrderCreate()->type($type)->get();
            $areas = Area::Nombre();
            $user = auth()->user();
            if ($user->can('edit', $person)) {
                return view('identification.people.edit', [
                    'person' => $person,
                    'institution' => $institutions,
                    'area' => $areas
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
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {
        try {
            $person = Person::findOrFail($id);
            $user = auth()->user();
            if ($user->can('update', $person)) {
                $person->update($request->validated());
                return redirect()->route('person.show', $person)->with('success', 'Usuario actualizado exitosamente');
            } else {
                return back()->with('error', 'Error: Not Authorized.');
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Person::findOrFail($id)->delete();
            return redirect()->route('person.index')->with('delete', 'Usuario eliminado exitosamente');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
}
