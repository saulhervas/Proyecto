<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionCliente;
use App\Models\Admin\Paises;
use App\Models\Admin\Poblacion;
use App\Models\Admin\Provincia;
use App\Models\Cliente;
use App\Models\Seguridad\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
      /**
     * Mostrar un listado de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('listar-clientes');
        $datas = Cliente::get();

        return view('cliente.index', compact('datas'));
    }


    /**
     * Mostrar un listado de cliente filtrado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request){

        can('listar-clientes');
        $datas = Cliente::with('usuario');

        if(!empty($request->dni_bus)){
            $datas->where('dni', $request->dni_bus);
        }

        $datas = $datas->get();
        $busqueda = $request;


        return view('cliente.index', compact('datas', 'busqueda'));
    }


    /**
     * Mostrar el formulario para crear una cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('añadir-clientes');

        $localidades = [0 => 'Seleccionar Provincia'];
        $provincias = Provincia::get()->pluck('provincia', 'id')->toArray();
        $paises = Paises::get()->pluck('nombre', 'id')->toArray();

        return view('cliente.crear', compact('localidades','provincias','paises'));
    }

    /**
     * Guardar una nueva cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionCliente $request)
    {
        can('añadir-clientes');
        $data = $request->except('foto');

        $cliente = Cliente::create($data);

        if($foto = Cliente::setArchivo($request->file('foto'), "cliente/$cliente->id/foto/")){
            $cliente->update(['foto' => $foto]);
        }

        $usuario = Usuario::create($request->all());
        $usuario->roles()->sync(3);
        $usuario->personal()->save($cliente);

        return redirect('cliente')->with('mensaje', 'Ficha cliente creada con exito');
    }

    /**
     * Mostrar el formulario para editar una cliente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('ver-clientes');

        $data = Cliente::with('usuario')->findOrFail($id);

        if ($data->provincia!='') {
            $localidades = Poblacion::where('provincia', '=', $data->provincia)->get()->pluck('municipio', 'id')->toArray();
        } else {
            $localidades = [0 => 'Seleccionar Provincia'];
        }
        $provincias = Provincia::get()->pluck('provincia', 'id')->toArray();
        $paises = Paises::get()->pluck('nombre', 'id')->toArray();

        if ($data->foto) $data->foto="cliente/$data->id/foto/$data->foto";

        if (!can('modificar-clientes',false)) {
            $data->only_view=1;
            $data->usuario->only_view=1;
        }

        return view('cliente.editar', compact('data','localidades','provincias','paises'));

    }

    /**
     * Actualizar una cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionCliente $request, $id)
    {
        can('modificar-clientes');

        $cliente = Cliente::with('usuario')->findOrFail($id);
        $data = $request->except('foto');

        if($foto = Cliente::setArchivo($request->file('foto'), "cliente/$cliente->id/foto/", $cliente->foto)){
            $cliente->update(['foto' => $foto]);
        }

        $cliente->update($data);

        $cliente->usuario->update(['email' => $request->email]);

        if(!$request->activo){
            $cliente->usuario->update(array('activo' => 0));
        }

        return redirect('cliente/'.$id.'/editar')->with('mensaje', 'Cliente actualizada con exito');
    }

    /**
     * Eliminar una cliente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        can('eliminar-clientes');
        if ($request->ajax()) {
            $cliente = Cliente::with('usuario')->findOrFail($id);
            $usuario = $cliente->usuario;
            
            if (Cliente::destroy($id)) {

                //Elimino el fichero
                Storage::disk('public')->delete("cliente/$cliente->id/foto/$cliente->foto");

                $usuario->delete();
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
