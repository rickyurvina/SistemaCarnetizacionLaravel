<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Person;
use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $people_id=$request->get('people_id');
        if (!empty($people_id))
        {
            $person=Person::orderby('created_at','asc')
                ->where('PER_CEDULA','LIKE',"%$people_id%")
                ->get('id');
            foreach ($person as $per) {
               $person_id= $per->id;
            }
            $photos=Photo::orderBy('people_id','DESC')
                ->where('people_id',$person_id)
                ->paginate(count(Person::get()));

        }
        else{
            $photos=Photo::orderBy('people_id','DESC')
                ->paginate(5);
        }
        if (empty($photos))
        {
            return view('identification.photos.index', compact('photos'));
        }
        return view('identification.photos.index', compact('photos'))
            ->with('info','No se encontro esa persona');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $people=person::orderBy('PER_NOMBRES','ASC')->get();
        return view('identification.photos.create',[
            'photo'=>new photo(),
            'people'=>$people
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        //
        $id=$request->get('people_id');
       $person=Photo::with('people')
            ->where('people_id','=',$id)->get();
        if (count($person)<=0)
        {
            photo::create($request->validated());
            return redirect()
                ->route('photo.index')
                ->with('info','Fotoregistrado exitosamente');
        }
        else{
            return back()->with('info','No se puede agregar, El usuario ya tiene asociada una foto');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
        return view('identification.photos.show',[
            'photo'=>$photo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
        $people=person::orderBy('PER_NOMBRES','ASC')->get();
        return view('identification.photos.edit',[
            'photo'=>$photo,
            'people'=>$people,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        //

        $id=$request->get('people_id');
        $person=Photo::with('people')
            ->where('people_id','=',$id)->get();
        if (count($person)<=0)
        {
            $photo->update( $request->validated() );
            return redirect()
                ->route('photo.show',$photo)
                ->with('info','Fondo actualizado exitosamente');
        }
        else{
            return back()->with('info','No se puede agregar, El usuario ya tiene asociada una foto');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        photo::findOrFail($id)->delete();
        return redirect()->route('photo.index')
            ->with('info','Foto eliminado exitosamente');

    }
}
