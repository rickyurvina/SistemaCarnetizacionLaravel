<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Models\Person;
use App\Models\Photo;
use Illuminate\Http\Request;
use Throwable;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            photo::create($request->validated());
            return redirect()
                ->route('photo.index')
                ->with('success','Foto registrada exitosamente');
        }catch(Throwable $e)
        {
            return back()
                ->with('error','Error: '.$e->getCode().
                    ' No se puede agregar, El usuario ya tiene asociada una foto');
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
        try{
            $people=person::OrderName()->get();
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

        try{
            $photo->update( $request->validated() );
            return redirect()
                ->route('photo.show',$photo)
                ->with('success','Fondo actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()
                ->with('error','Error: '.$e->getCode().
                    ' No se puede agregar, El usuario ya tiene asociada una foto');
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
