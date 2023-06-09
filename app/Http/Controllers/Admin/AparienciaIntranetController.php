<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AparienciaIntranet;
use Illuminate\Http\Request;

class AparienciaIntranetController extends Controller
{
    public function index(){
        if($data = AparienciaIntranet::find(1)) $data;

        $asides = [
            'sidebar-dark-primary' => 'fondo-oscuro-azul',
            'sidebar-dark-warning' => 'fondo-oscuro-amarillo',
            'sidebar-dark-info' => 'fondo-oscuro-azul-claro',
            'sidebar-dark-danger' => 'fondo-oscuro-rojo',
            'sidebar-dark-success' => 'fondo-oscuro-verde',
            'sidebar-dark-indigo' => 'fondo-oscuro-morado',
            'sidebar-dark-navy' => 'fondo-oscuro-azul-oscuro',
            'sidebar-dark-purple' => 'fondo-oscuro-purpura',
            'sidebar-dark-fuchsia' => 'fondo-oscuro-fucsia',
            'sidebar-dark-pink' => 'fondo-oscuro-rosa',
            'sidebar-dark-maroon' => 'fondo-oscuro-marron',
            'sidebar-dark-orange' => 'fondo-oscuro-naranja',
            'sidebar-dark-lime' => 'fondo-oscuro-verde-lima',
            'sidebar-dark-teal' => 'fondo-oscuro-verde-azulado',
            'sidebar-dark-olive' => 'fondo-oscuro-verde-oliva',
            'sidebar-light-primary' => 'fondo-claro-azul',
            'sidebar-light-warning' => 'fondo-claro-amarillo',
            'sidebar-light-info' => 'fondo-claro-azul-claro',
            'sidebar-light-danger' => 'fondo-claro-rojo',
            'sidebar-light-success' => 'fondo-claro-verde',
            'sidebar-light-indigo' => 'fondo-claro-morado',
            'sidebar-light-navy' => 'fondo-claro-azul-oscuro',
            'sidebar-light-purple' => 'fondo-claro-purpura',
            'sidebar-light-fuchsia' => 'fondo-claro-fucsia',
            'sidebar-light-pink' => 'fondo-claro-rosa',
            'sidebar-light-maroon' => 'fondo-claro-marron',
            'sidebar-light-orange' => 'fondo-claro-naranja',
            'sidebar-light-lime' => 'fondo-claro-verde-lime',
            'sidebar-light-teal' => 'fondo-claro-verde-azulado',
            'sidebar-light-olive' => 'fondo-claro-verde-oliva'];

        $card_colors = [
            'card-primary' => 'azul',
            'card-warning' => 'amarillo',
            'card-info' => 'azul-claro',
            'card-danger' => 'rojo',
            'card-success' => 'verde',
            'card-indigo' => 'morado',
            'card-navy' => 'azul-oscuro',
            'card-purple' => 'purpura',
            'card-fuchsia' => 'fucsia',
            'card-pink' => 'rosa',
            'card-maroon' => 'marron',
            'card-orange' => 'naranja',
            'card-lime' => 'verde-lima',
            'card-teal' => 'verde-azulado',
            'card-olive' => 'verde-oliva'];

        $navbars = [
            'navbar-primary' => 'azul',
            'navbar-secondary' => 'gris',
            'navbar-info' => 'azul-claro',
            'navbar-success' => 'verde',
            'navbar-danger' => 'rojo',
            'navbar-indigo' => 'morado',
            'navbar-purple' => 'purpura',
            'navbar-pink' => 'rosa',
            'navbar-teal' => 'verde-azulado',
            'navbar-dark' => 'oscuro',
            'navbar-gray-dark' => 'gris-oscuro',
            'navbar-light' => 'claro',
            'navbar-warning' => 'amarillo',
            'navbar-white' => 'blanco',
            'navbar-orange' => 'naranja'];



        return view('admin.apariencia.index', compact('asides', 'navbars','data','card_colors'));
    }

    public function actualizar(Request $request){

        if($apariencia = AparienciaIntranet::find(1)){
            $apariencia->update($request->all());
        }else{
            AparienciaIntranet::create($request->all());
        }

        return redirect('admin/apariencia')->with('mensaje', 'Apariencia actualizada con exito');
    }
}
