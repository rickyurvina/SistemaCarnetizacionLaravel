<?php

namespace App\Http\Controllers;

use App\Models\Aprobadas;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class AprobadasController extends Controller
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

    public function index()
    {
        //
        try {
            $key = "solicitadas.page." . request('page', 1) . request('institution_id', null);
            $institutions = Institution::OrderCreate()->get();
            $aprobadas = Cache::remember($key, 180, function () {
                $institution_id = request('institution_id');
                return Aprobadas::WithSoliIns()->OrderWhere($institution_id)->paginate(15);
            });
            return view('identification.approved.index', compact('aprobadas', 'institutions'))
                ->with('error', 'No se encuentran registros');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aprobadas  $aprobadas
     * @return \Illuminate\Http\Response
     */
    public function show(Aprobadas $aprobadas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aprobadas  $aprobadas
     * @return \Illuminate\Http\Response
     */
    public function edit(Aprobadas $aprobadas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aprobadas  $aprobadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aprobadas $aprobadas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aprobadas  $aprobadas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aprobadas $aprobadas)
    {
        //
    }
}
