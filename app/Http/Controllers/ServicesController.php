<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Institution;
use App\Models\Person;
use App\Models\Photo;
use App\Models\Picture;
use App\Models\Solicitadas;
use App\Models\Student;
//use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function profile()
    {
        try{
            $cedula=auth()->user()->cedula;
            $students=Student::StudentCedula($cedula)->get();
            $people=Person::FindCedula($cedula)->get();
            if (auth()->user()->isAdmin())
            {
                $user=auth()->user();
                return view('identification.users.show',[
                    'user'=>$user
                ]);
            }
            if (count($students)>0)
            {
                foreach ($students as $student)
                {
                    $student_id=$student->id;
                    $picture=Picture::Id($student_id)->get();
                    return view('identification.students.show',[
                        'student'=>$student,
                        'picture'=>$picture
                    ]);
                }
            }else{
                foreach ($people as $person)
                {
                    $person_id=$person->id;
                    $photo=Photo::Id($person_id)->get();
                    return view('identification.people.show',[
                        'person'=>$person,
                        'photos'=>$photo
                    ]);
                }
            }
        }catch(Throwable $e){
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    public static function photo($cedula){

        try{
            $students=Student::StudentCedula($cedula)->get();
            $people=Person::FindCedula($cedula)->get();
            if (auth()->user()->isAdmin())
            {
                return 'images/user.png';
            }
            if (count($students)>0)
            {
                foreach ($students as $student)
                {
                    $student_id=$student->id;
                    $pictures=Picture::Id($student_id)->get('nombre');
                    foreach ($pictures as $picture) {
                        $name=$picture->nombre;
                        return 'images/StudentsPhotos/'.$name;
                    }
                }
            }
            else{
                foreach ($people as $person) {
                    $person_id=$person->id;
                    $photos=Photo::Id($person_id)->get('nombre');
                    foreach ($photos as $photo)
                    {
                        $name=$photo->nombre;
                        return 'images/PeoplePhotos/'.$name;
                    }
                }
            }


        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    public function solicitadas()
    {
        try{
            $solicitadas=new Solicitadas();
            $cedula=auth()->user()->cedula;
            $solicitadas->cedula=$cedula;
            $students=Student::where('EST_CEDULA',$cedula)->get();
            $person=Person::where('PER_CEDULA',$cedula)->get();
            if (count($students)>0)
            {
                $solicitadas->tipo='Estudiante';
                foreach ($students as $student)
                {
                    $institution_id=$student->institution_id;
                }
                $solicitadas->institution_id=$institution_id;

            }
            else{
                $solicitadas->tipo='Usuario';
                foreach ($person as $per)
                {
                    $institution_id=$per->institution_id;
                }
                $solicitadas->institution_id=$institution_id;
            }
            $solicitadas->save();
            return back()->with('success','Solicitud realizada');
        }catch(Throwable $e){
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

}
