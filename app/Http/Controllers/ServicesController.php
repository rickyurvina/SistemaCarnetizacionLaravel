<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Photo;
use App\Models\Picture;
use App\Models\Student;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function profile()
    {
        $cedula=auth()->user()->cedula;
        $students=Student::where('EST_CEDULA',$cedula)->get();
        $people=Person::where('PER_CEDULA',$cedula)->get();
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
                $picture=Picture::where('student_id',$student_id)->get();
                return view('identification.students.show',[
                    'student'=>$student,
                    'picture'=>$picture
                ]);
            }
        }else{
            foreach ($people as $person)
            {
                $person_id=$person->id;
                $photo=Photo::where('people_id',$person_id)->get();
                return view('identification.people.show',[
                    'person'=>$person,
                    'photos'=>$photo
                ]);
            }
        }
    }
    public static function photo($cedula){

        $students=Student::where('EST_CEDULA',$cedula)->get();
        $people=Person::where('PER_CEDULA',$cedula)->get();
        foreach ($people as $person) {
            $person_id=$person->id;
            $photos=Photo::where('people_id',$person_id)->get('nombre');
            foreach ($photos as $photo)
            {
                $name=$photo->nombre;
                return 'images/PeoplePhotos/'.$name;
            }

        }
        foreach ($students as $student)
        {
            $student_id=$student->id;
            $pictures=Picture::where('student_id',$student_id)->get('nombre');
            foreach ($pictures as $picture) {
                $name=$picture->nombre;
                return 'images/StudentsPhotos/'.$name;
            }
        }

    }
}
