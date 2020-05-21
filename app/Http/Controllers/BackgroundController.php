<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Http\Requests\BackgroundRequest;
use App\Models\Institution;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Throwable;

class BackgroundController extends Controller
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
    public function index(Request $request)
    {
        try{
            $institutions=Background::WithInstitution()->get();
            $institution_id=$request->get('institution_id');
            $backgrounds=Background::Order()->Institution($institution_id)->paginate(5);
            return view('identification.backgrounds.index',compact('backgrounds','institutions'))
                ->with('error','No se encontro esa institutcion');
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
        try{
            $institutions=Institution::OrderCreate()->get();
            return view('identification.backgrounds.create',[
                'background'=>new Background(),
                'institution'=>$institutions
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BackgroundRequest $request)
    {
        try{
            if (!$request->FON_NOMBRE)
            {
                return back()->with('error','No selecciono ninguna imagen');
            }
            else{
                $post= background::create($request->validated());
                if ($request->hasFile('FON_NOMBRE'))
                {
                    $extension=$request->file('FON_NOMBRE')->getClientOriginalExtension();
                    $institution_id=$request->institution_id;
                    $cedula=Institution::InstitutionId($institution_id);
                    foreach ($cedula as $ced)
                    {
                        $cedula_stu=$ced->INS_NOMBRE;
                    }
                    $file_name=$cedula_stu.'.'.$extension;
                    Image::make($request->file('FON_NOMBRE'))->resize(354,213)->save('images/BackgroundsPhotos/'.'frontal'.$file_name);
                    $post->FON_NOMBRE='frontal'.$file_name;
                    $post->save();
                }
                if ($request->hasFile('FON_NOMBRE2'))
                {
                    $extension=$request->file('FON_NOMBRE2')->getClientOriginalExtension();
                    $institution_id=$request->institution_id;
                    $cedula=Institution::InstitutionId($institution_id);
                    foreach ($cedula as $ced)
                    {
                        $cedula_stu=$ced->INS_NOMBRE;
                    }
                    $file_name=$cedula_stu.'.'.$extension;
                    Image::make($request->file('FON_NOMBRE2'))->resize(354,213)->save('images/BackgroundsPhotos/'.'posterior'.$file_name);
                    $post->FON_NOMBRE2='posterior'.$file_name;
                    $post->save();
                }
                return redirect()
                    ->route('background.index')->with('success','Foto registrada exitosamente');
            }

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function show(Background $background)
    {
        try{
            return view('identification.backgrounds.show',[
                'background'=>$background,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function edit(Background $background)
    {
        try{
            $institution_id=$background->institution_id;
            $institutions=Institution::InsId($institution_id);
            return view('identification.backgrounds.edit',[
                'background'=>$background,
                'institution'=>$institutions,
            ]);

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function update(BackgroundRequest $request, Background $background)
    {
        try
        {
            $post=background::find($background->id);
            $post->fill($request->validated())->save();
            if ($request->hasFile('FON_NOMBRE'))
            {
                $extension=$request->file('FON_NOMBRE')->getClientOriginalExtension();
                $institution_id=$request->institution_id;
                $cedula=Institution::InstitutionId($institution_id);
                foreach ($cedula as $ced)
                {
                    $cedula_stu=$ced->INS_NOMBRE;
                }
                $file_name=$cedula_stu.'.'.$extension;
                Image::make($request->file('FON_NOMBRE'))->resize(354,213)->save('images/BackgroundsPhotos/'.'frontal'.$file_name);
                $post->FON_NOMBRE='frontal'.$file_name;
                $post->save();
            }
            if ($request->hasFile('FON_NOMBRE2'))
            {
                $extension=$request->file('FON_NOMBRE2')->getClientOriginalExtension();
                $institution_id=$request->institution_id;
                $cedula=Institution::InstitutionId($institution_id);
                foreach ($cedula as $ced)
                {
                    $cedula_stu=$ced->INS_NOMBRE;
                }
                $file_name=$cedula_stu.'.'.$extension;
                Image::make($request->file('FON_NOMBRE2'))->resize(354,213)->save('images/BackgroundsPhotos/'.'posterior'.$file_name);
                $post->FON_NOMBRE2='posterior'.$file_name;
                $post->save();
            }
            return redirect()
                ->route('background.show',$background)->with('success','Logo actualizado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().
                'No se puede modificar, El background ya tiene una foto asociada');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Background::findOrFail($id)->delete();
            return redirect()->route('background.index')->with('delete','Fondo eliminado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
}
