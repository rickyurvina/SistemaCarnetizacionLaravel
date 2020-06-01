<?php

namespace App\Http\Controllers;


use App\Models\Person;
use App\Models\Photo;
use App\Models\Picture;
use App\Models\Solicitadas;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function profile()
    {
        try {
            $cedula = auth()->user()->cedula;
            $students = Student::StudentCedula($cedula)->get();
            $people = Person::FindCedula($cedula)->get();
            if (auth()->user()->isAdmin()) {
                $user = auth()->user();
                return view('identification.users.show', [
                    'user' => $user
                ]);
            }
            if (count($students) > 0) {
                foreach ($students as $student) {
                    $student_id = $student->id;
                    $picture = Picture::Id($student_id)->get();
                    return view('identification.students.show', [
                        'student' => $student,
                        'picture' => $picture
                    ]);
                }
            } else {
                foreach ($people as $person) {
                    $person_id = $person->id;
                    $photo = Photo::Id($person_id)->get();
                    return view('identification.people.show', [
                        'person' => $person,
                        'photos' => $photo
                    ]);
                }
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public static function photo($cedula)
    {

        try {
            $students = Student::StudentCedula($cedula)->get();
            $people = Person::FindCedula($cedula)->get();
            if (auth()->user()->isAdmin()) {
                return 'images/user.png';
            }
            if (count($students) > 0) {
                foreach ($students as $student) {
                    $student_id = $student->id;
                    $pictures = Picture::Id($student_id)->get('nombre');
                    foreach ($pictures as $picture) {
                        $name = $picture->nombre;
                        return 'images/StudentsPhotos/' . $name;
                    }
                }
            } else {
                foreach ($people as $person) {
                    $person_id = $person->id;
                    $photos = Photo::Id($person_id)->get('nombre');
                    foreach ($photos as $photo) {
                        $name = $photo->nombre;
                        return 'images/PeoplePhotos/' . $name;
                    }
                }
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }

    public function solicitadas()
    {
        try {
            $solicitadas = new Solicitadas();
            $cedula = auth()->user()->cedula;
            $solicitadas->cedula = $cedula;
            $students = Student::StudentCedula($cedula)->get();
            $person = Person::Id($cedula)->get();
            if (count($students) > 0) {
                $solicitadas->tipo = 'Estudiante';
                foreach ($students as $student) {
                    $institution_id = $student->institution_id;
                }
                $solicitadas->institution_id = $institution_id;
            } else {
                $solicitadas->tipo = 'Usuario';
                foreach ($person as $per) {
                    $institution_id = $per->institution_id;
                }
                $solicitadas->institution_id = $institution_id;
            }
            $solicitadas->save();
            return back()->with('success', 'Solicitud realizada');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function solicitudImpresion()
    {
        try {
            $cedula = auth()->user()->cedula;
            if (auth()->user()->hasRoles(['representanteEducativa'])) {
                $student = Student::StudentCedula($cedula)->get('institution_id');
                foreach ($student as $stu) {
                    $ins_id = $stu->institution_id;
                    $students = Student::InstitutionId($ins_id)->get();
                    foreach ($students as $student) {
                        $cedula_estudiante = $student->EST_CEDULA;
                        $institution_id = $student->institution_id;
                        $solicitadas = new Solicitadas();
                        $solicitadas->cedula = $cedula_estudiante;
                        $solicitadas->tipo = 'Estudiante';
                        $solicitadas->institution_id = $institution_id;
                        $solicitadas->save();
                    }
                    return back()->with('success', 'Registrado extisoamente');
                }
            } else {

                $people = Person::FindCedula($cedula)->get('institution_id');
                foreach ($people as $person) {
                    $ins_id = $person->institution_id;
                    $peoples = Person::InstitutionId($ins_id)->get();
                    foreach ($peoples as $persons) {
                        $cedula_person = $persons->PER_CEDULA;
                        $institution_id = $persons->institution_id;
                        $solicitadas = new Solicitadas();
                        $solicitadas->cedula = $cedula_person;
                        $solicitadas->tipo = 'Usuario';
                        $solicitadas->institution_id = $institution_id;
                        $solicitadas->save();
                    }
                    return back()->with('success', 'Registrado extisoamente');
                }
            }
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
    public function mail(Request $request)
    {
        $message = $request->get('email');
        Mail::send('auth.mail', ['msg' => $message], function ($m) use ($message) {
            $m->to("ricky_uc12@hotmail.com")->subject('Reseteo de clave');
        });
        return back()->with('success', 'Hemos recibido tu solicitud, pronto nos pondremos en contacto');
    }

    public function carnet()
    {
        return view('identification.print.carnet');
    }
}
