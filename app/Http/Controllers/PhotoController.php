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

    public function index()
    {
        try {
            if (auth()->user()->isAdmin()) {
                if (!empty(request('people_id'))) {
                    $person = Person::Order()->Id(request('people_id'))->get('id');
                    foreach ($person as $per) {
                        $person_id = $per->id;
                    }
                    $photos = Photo::WithPer()->Id($person_id)->paginate(count(Person::get()));
                } else {
                    $photos = Photo::WithPer()->paginate(5);
                }
            } else {
                return back();
            }

            return view('identification.photos.index', compact('photos'));

        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
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
                $people = person::OrderName()->get();
                return view('identification.photos.create', [
                    'photo' => new photo(),
                    'people' => $people
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
    public function store(PhotoRequest $request)
    {
        //
        try {
            if (!$request->nombre) {
                return back()->with('error', 'No selecciono ninguna imagen');
            } else {
                $post = photo::create($request->validated());
                $request->file('nombre');

                if ($request->hasFile('nombre')) {
                    $extension = $request->file('nombre')->getClientOriginalExtension();
                    $people_id = $request->people_id;
                    $person = Person::PeopleId($people_id);
                    foreach ($person as $ced) {
                        $cedula_stu = $ced->PER_CEDULA;
                    }
                    $file_name = $cedula_stu . '.' . $extension;
                    Image::make($request->file('nombre'))->resize(375, 508)->save('images/PeoplePhotos/' . $file_name);
                    $post->nombre = $file_name;
                    $post->save();
                }
                return redirect()
                    ->route('photo.index')
                    ->with('success', 'Foto registrada exitosamente');
            }
        } catch (Throwable $e) {
            return back()
                ->with('error', 'Error: ' . $e->getCode() . ' El usuario:' . $request->people_id . ' ya tiene una foto asociada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
        try {
            $person_id = $photo->people_id;
            $person = Person::findOrFail($person_id);
            $user = auth()->user();
            if ($user->can('show', $person)) {
                return view('identification.photos.show', [
                    'photo' => $photo,
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
     * @param \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        try {
            $people_id = $photo->people_id;
            $person = Person::findOrFail($people_id);
            $user = auth()->user();
            if ($user->can('edit', $person)) {
                $people = person::PersonId($people_id);
                return view('identification.photos.edit', [
                    'photo' => $photo,
                    'people' => $people,
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
     * @param \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        try {
            $people_id = $photo->people_id;
            $person = Person::findOrFail($people_id);
            $user = auth()->user();
            if ($user->can('update', $person)) {
                $post = Photo::find($photo->id);
                $post->fill($request->validated())->save();
                if ($request->hasFile('nombre')) {
                    $extension = $request->file('nombre')->getClientOriginalExtension();
                    $people_id = $request->people_id;
                    $cedula = Person::PeopleId($people_id);
                    foreach ($cedula as $ced) {
                        $cedula_stu = $ced->PER_CEDULA;
                    }
                    $file_name = $cedula_stu . '.' . $extension;
                    Image::make($request->file('nombre'))->resize(375, 508)->save('images/PeoplePhotos/' . $file_name);
                    $post->nombre = $file_name;
                    $post->save();
                }
                return redirect()
                    ->route('photo.show', $photo)
                    ->with('success', 'Foto actualizado exitosamente');
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
     * @param \App\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            photo::findOrFail($id)->delete();
            return redirect()->route('photo.index')
                ->with('delete', 'Foto eliminado exitosamente');
        } catch (Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getCode() . ' ' . $e->getMessage());
        }
    }
}
