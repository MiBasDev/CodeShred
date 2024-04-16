<?php

namespace CodeShred\Controllers;

class InicioController extends \CodeShred\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );        
//        $modeloCategorias = new \CodeShred\Models\CategoriaModel();
//        $data['numCategorias'] = $modeloCategorias->size();
//        
//        $modeloProductos = new \CodeShred\Models\ProductoModel();
//        $data['numProductos'] = $modeloProductos->size();
//        
//        $modeloProveedores = new \CodeShred\Models\ProveedorModel();
//        $data['numProveedores'] = $modeloProveedores->size();
        
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }
    
    public function demoUsuariosSistema(){
        $data = [
            'seccion' => '/demos/usuarios-sistema',
            'titulo' => 'Usuarios sistema',
            'breadcrumb' => ['Inicio', 'Usuarios sistema']
            ];
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'demo-listado-usuarios.php', 'templates/footer.view.php'), $data);
    }
    
    public function demoUsuariosSistemaAdd(){
        $data = [
            'seccion' => '/demos/usuarios-sistema/add',
            'titulo' => 'Alta Usuario sistema',
            'breadcrumb' => ['Inicio', 'Usuarios sistema', 'Editar']
            ];
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'demo-add.usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function login(){
        $data = [];
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
    }
}
