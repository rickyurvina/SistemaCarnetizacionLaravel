<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogoRequest;
use App\Models\Institution;
use App\Models\Logo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Throwable;

class LogoController extends Controller
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
            $institutions=logo::WithInstitution();
            $institution_id=$request->get('institution_id');
            $logos=Logo::Order()->InstitutionId($institution_id)->paginate(5);
            return view('identification.logos.index', compact('logos','institutions'))
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
            return view('identification.logos.create',[
                'logo'=>new logo(),
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
    public function store(LogoRequest $request)
    {

        try{
            if (!$request->LOG_NOMBRE)
            {
                return back()->with('error','No selecciono ninguna imagen');
            }
            else{
                $post= logo::create($request->validated());
                if ($request->hasFile('LOG_NOMBRE'))
                {
                    $extension=$request->file('LOG_NOMBRE')->getClientOriginalExtension();
                    $institution_id=$request->institution_id;
                    $cedula=Institution::InstitutionId($institution_id);
                    foreach ($cedula as $ced)
                    {
                        $cedula_stu=$ced->INS_NOMBRE;
                    }
                    $file_name=$cedula_stu.'.'.$extension;
                    Image::make($request->file('LOG_NOMBRE'))->resize(354,213)->save('images/LogosPhotos/'.$file_name);
                    $post->LOG_NOMBRE=$file_name;
                    $post->save();
                }
                return redirect()
                    ->route('logo.index')->with('success','Foto registrada exitosamente');
            }
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        try{
            return view('identification.logos.show',[
                'logo'=>$logo,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        try{
            $institution_id=$logo->institution_id;
            $institutions=Institution::InsId($institution_id);
            return view('identification.logos.edit',[
                'logo'=>$logo,
                'institution'=>$institutions,
            ]);
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage().' '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(LogoRequest $request, $id)
    {
        try
        {
            $post=logo::find($id);
            $post->fill($request->validated())->save();
            if ($request->hasFile('LOG_NOMBRE'))
            {
                $extension=$request->file('LOG_NOMBRE')->getClientOriginalExtension();
                $institution_id=$request->institution_id;
                $cedula=Institution::InstitutionId($institution_id);
                foreach ($cedula as $ced)
                {
                    $cedula_stu=$ced->INS_NOMBRE;
                }
                $file_name=$cedula_stu.'.'.$extension;
                Image::make($request->file('LOG_NOMBRE'))->resize(354,213)->save('images/LogosPhotos/'.$file_name);
                $post->LOG_NOMBRE=$file_name;
                $post->save();
            }
            return redirect()
                ->route('logo.show',$id)->with('success','Logo actualizado exitosamente');

        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            logo::findOrFail($id)->delete();
            return redirect()->route('logo.index')->with('delete','Fondo eliminado exitosamente');
        }catch(Throwable $e)
        {
            return back()->with('error','Error: '.$e->getCode().' '.$e->getMessage());
        }
    }
}
