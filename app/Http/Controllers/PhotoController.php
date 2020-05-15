<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Models\Person;
use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Throwable;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin,usuario');
    }
    public function index(Request $request)
    {
        try{
            $people_id=$request->get('people_id');
            if (!empty($people_id))
            {
                $person=Person::Order()->Id($people_id)->get('id');
                foreach ($person as $per) {
                    $person_id= $per->id;
                }
                $photos=Photo::Order()->Id($person_id)->paginate(count(Person::get()));
            }
            else{
                $photos=Photo::Order()
                    ->paginate(5);
            }
            if (empty($photos))
            {
                return view('identification.photos.index', compact('photos'));
            }
            return view('identification.photos.index', compact('photos'))
                ->with('error','No se encontro esa persona');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
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
            $people=person::OrderName()->get();
            return view('identification.photos.create',[
                'photo'=>new photo(),
                'people'=>$people
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
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
        try{
            if (!$request->nombre)
            {
                return back()->with('error','No selecciono ninguna imagen');
            }
            else{
                $post= photo::create($request->validated());

                if ($request->hasFile('nombre'))
                {
                    $extension=$request->file('nombre')->getClientOriginalExtension();
                      $people_id=$request->people_id;
                    $cedula=Person::PeopleId($people_id);
                    foreach ($cedula as $ced)
                    {
                        $cedula_stu=$ced->PER_CEDULA;
                    }
                    $file_name=$cedula_stu.'.'.$extension;
                    Image::make($request->file('nombre'))
                        ->resize(375,508)
                        ->save('images/PeoplePhotos/'.$file_name);
                    $post->nombre=$file_name;
                    $post->save();
                }
                return redirect()
                    ->route('photo.index')
                    ->with('success','Foto registrada exitosamente');
            }
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
                'No se puede agregar, El estudiante ya tiene una foto asociada');
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
        try{
            return view('identification.photos.show',[
                'photo'=>$photo,
            ]);

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
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
        $people_id=$photo->people_id;
        try{
            $people=person::PersonId($people_id);
            return view('identification.photos.edit',[
                'photo'=>$photo,
                'people'=>$people,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
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
        try
        {
            $post=Photo::find($photo->id);
            $post->fill($request->validated())->save();
            if ($request->hasFile('nombre'))
            {
                $extension=$request->file('nombre')->getClientOriginalExtension();
                $people_id=$request->people_id;
                $cedula=Person::PeopleId($people_id);
                foreach ($cedula as $ced)
                {
                    $cedula_stu=$ced->PER_CEDULA;
                }
                $file_name=$cedula_stu.'.'.$extension;
                Image::make($request->file('nombre'))
                    ->resize(375,508)
                    ->save('images/PeoplePhotos/'.$file_name);
                $post->nombre=$file_name;
                $post->save();
            }
            return redirect()
                ->route('photo.show',$photo)
                ->with('success','Foto actualizado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
                'No se puede modificar, El usuario ya tiene una foto asociada');
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
        try{
            photo::findOrFail($id)->delete();
            return redirect()->route('photo.index')
                ->with('delete','Foto eliminado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode());
        }
    }
}
