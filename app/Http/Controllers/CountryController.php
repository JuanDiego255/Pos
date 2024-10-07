<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryU;

class CountryController extends Controller
{
    public function index()
    {
        return view('admin.countries.list');
    }

    public function get()
    {
        $countries     = CountryU::orderBy('id', 'DESC')->get();
        return Datatables()
                    ->of($countries)
                    ->addColumn('acciones', function($countries){
                        $id     = $countries->id;
                        $btn    = '<div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"/></svg></button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item btn-detail" data-id="'.$id.'" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50 menu-icon"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span> Editar</span>
                                        </a>
                                        <a class="dropdown-item btn-confirm" data-id="'.$id.'" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50 menu-icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            <span> Eliminar</span>
                                        </a>
                                    </div>
                                </div>';
                        return $btn;
                    })
                    ->rawColumns(['acciones'])
                    ->make(true);   
    }

    public function save(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
            return;
        }

        $descripcion        = trim($request->input('descripcion'));
        $prefijo            = trim($request->input('prefijo'));
        $codigo_telefono    = trim($request->input('codigo_telefono'));
        $signo              = trim($request->input('signo'));
        $moneda             = trim($request->input('moneda'));

        CountryU::insert([
            'descripcion'       => mb_strtoupper($descripcion),
            'prefijo'           => mb_strtoupper($prefijo),
            'codigo_telefono'   => mb_strtoupper($codigo_telefono),
            'signo'             => mb_strtoupper($signo),
            'moneda'            => mb_strtoupper($moneda),
            'estado'            => 1
        ]);

        echo json_encode([
            'status'    => true,
            'msg'       => 'Registro insertado correctamente',
            'type'      => 'success'
        ]);
    }

    public function detail(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
            return;
        }

        $id         = $request->input('id');
        $country    = CountryU::where('id', $id)->first();
        echo json_encode(['status'  => true, 'country' => $country]);
    }

    public function store(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
            return;
        }

        $id                 = $request->input('id');
        $descripcion        = trim($request->input('descripcion'));
        $prefijo            = trim($request->input('prefijo'));
        $codigo_telefono    = trim($request->input('codigo_telefono'));
        $signo              = trim($request->input('signo'));
        $moneda             = trim($request->input('moneda'));

        CountryU::where('id', $id)->update([
            'descripcion'       => mb_strtoupper($descripcion),
            'prefijo'           => mb_strtoupper($prefijo),
            'codigo_telefono'   => mb_strtoupper($codigo_telefono),
            'signo'             => mb_strtoupper($signo),
            'moneda'            => mb_strtoupper($moneda),
            'estado'            => 1
        ]);

        echo json_encode([
            'status'    => true,
            'msg'       => 'Registro actualizado correctamente',
            'type'      => 'success'
        ]);
    }

    public function delete(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
            return;
        }

        $id            = $request->input('id');
        CountryU::where('id', $id)->delete();

        echo json_encode([
            'status'    => true,
            'msg'       => 'Registro eliminado con éxito',
            'type'      => 'success'
        ]);
    }
}
