<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\provedor;

class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $provedor = provedor::where('id','>=',1)->get();
        $cont =provedor::count();
        $provedor= $this->cargarDT($provedor);
        return view('provedor.index')->with('provedor',$provedor)->with('cont',$cont);
    }
    public function cargarDT($consulta)
    {
        $provedor = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-provedor'

                , $value['id']);
            $actualizar =  route('provedor.edit', $value['id']);

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="#/* '.$actualizar.' */" role="button" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#'.$ruta.'">
                        Eliminar
                        </button>
                    </div>
                </div>
                 <!-- Modal -->
            <div class="modal fade" id="'.$ruta.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este provedor?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-primary">
                        <small>
                            '.$value['id'].', '.$value['nombre'].'                 </small>
                      </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            ';

            $provedor[$key] = array(
                $acciones,
                $value['id'],
                $value['user_id'],
                $value['nombre'],
                $value['direccion'],
                $value['created_at'],
                $value['updated_at']
              

            );

        }

        return $provedor;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('provedor.create');

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
        $validaData = $this ->validate($request,[
            'nombre'=>'required|min:5',
            'direccion'=>'required'
           
        ]);
        $provedor= new provedor();
        $user=\Auth::user();
        $provedor->user_id = $user->id;
        $provedor->nombre =$request->input('nombre');
        $provedor->direccion =$request->input ('direccion');



        $provedor ->save();
        return redirect()->route('provedor.index')
         ->with(array(
            'message'=>'El provedor se ha creado correctamente'
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $provedor=provedor::find($id);

        //abre el formulario para edición de un registro
        return view('provedor.edit')->with('provedor',$provedor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validaData = $this ->validate($request,[
            'nombre'=>'required|min:5',
            'direccion'=>'required'
           
        ]);

        $user=\Auth::user();
       $provedor= provedor::find($id);
        $provedor->user_id = $user->id;
        $provedor->nombre =$request->input('nombre');
       
        $provedor->direccion =$request->input ('direccion');

        
        $provedor ->update();
        return redirect()->route('provedor.index')
            ->with(array(
                'message'=>'El provedor se ha guardado correctamente'
            ));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete_provedor($provedor_id){
        $video = Video::find($provedor_id);
        if($provedor){
            $provedor->status = 0;
            $provedor->update();
            return redirect()->route('provedor.index')->with(array(
                "message" => "El provedor se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('provedor.index')->with(array(
                "message" => "El provedor que trata de eliminar no existe"
            ));
        }

    }
}
