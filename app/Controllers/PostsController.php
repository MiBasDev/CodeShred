<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class PostsController extends \CodeShred\Core\BaseController {
       
    private const IVAS = [0, 4, 10, 21];
    
    function mostrar(){
        $data = [];
        $data['title'] = 'codeShred | Post';
        $data['section'] = '/post';

        
        $modelo = new \CodeShred\Models\PostsModel();
        //$data['productos'] = $modelo->loadPost();
        
//        if(isset($_SESSION['mensaje_productos'])){
//            $data['mensaje'] = $_SESSION['mensaje_productos'];
//            unset($_SESSION['mensaje_productos']);
//        }
        
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarTodos(){
        $data = [];
        $data['title'] = 'codeShred | Posts';
        $data['section'] = '/posts';
        
        $modelo = new \CodeShred\Models\PostsModel();
        //$data['posts'] = $modelo->getAll();
        
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarAdd(){
        $data = [];
        $data['titulo'] = 'Todos los productos';
        $data['seccion'] = '/productos/add';
        $data['tituloDiv'] = 'Alta producto';
        
        $categoriaModel = new \CodeShred\Models\CategoriaModel();
        $data['categorias'] = $categoriaModel->getAllCategorias();
        $data['ivas'] = self::IVAS;
        //var_dump($data['categorias']); die();
        
        $proveedoresModel = new \CodeShred\Models\ProveedorModel();
        $data['proveedores'] = $proveedoresModel->getAll();
        
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.code-fragments.view.php', 'templates/footer.view.php'), $data);
    }
    
    function view(string $id){
        $data = [];
        $modelo = new \CodeShred\Models\ProductoModel();
        $input = $modelo->loadProducto($id);
        if(is_null($input)){
            header('location: /productos');
        }
        else{
            $data['titulo'] = 'Mostrando producto: '. $input['nombre'];
            $data['tituloDiv'] = 'Datos del producto';
            $data['seccion'] = '/productos/view';
            $data['ivas'] = self::IVAS;
            
            $data['input'] = $input;

            $categoriaModel = new \CodeShred\Models\CategoriaModel();
            $data['categorias'] = $categoriaModel->getAllCategorias();
            //var_dump($data['categorias']); die();

            $proveedoresModel = new \CodeShred\Models\ProveedorModel();
            $data['proveedores'] = $proveedoresModel->getAll();

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.code-fragments.view.php', 'templates/footer.view.php'), $data);
        }
    }
    
    function mostrarEdit(string $id){
        $data = [];
        $modelo = new \CodeShred\Models\ProductoModel();
        $input = $modelo->loadProducto($id);
        if(is_null($input)){
            header('location: /productos');
        }
        else{
            $data['titulo'] = 'Editando producto: '. $input['nombre'];
            $data['tituloDiv'] = 'Modificar producto';
            $data['seccion'] = '/productos/edit';
            $data['ivas'] = self::IVAS;
            
            $data['input'] = $input;

            $categoriaModel = new \CodeShred\Models\CategoriaModel();
            $data['categorias'] = $categoriaModel->getAllCategorias();
            //var_dump($data['categorias']); die();

            $proveedoresModel = new \CodeShred\Models\ProveedorModel();
            $data['proveedores'] = $proveedoresModel->getAll();

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.code-fragments.view.php', 'templates/footer.view.php'), $data);
        }
    }
    
    function processAdd(){
        $errores = $this->checkForm($_POST);
        if(count($errores) > 0){
            $data = [];
            $data['titulo'] = 'Insertar producto';
            $data['seccion'] = '/productos/add';
            $data['tituloDiv'] = 'Alta producto';

            $categoriaModel = new \CodeShred\Models\CategoriaModel();
            $data['categorias'] = $categoriaModel->getAllCategorias();
            $data['ivas'] = self::IVAS;
            //var_dump($data['categorias']); die();

            $proveedoresModel = new \CodeShred\Models\ProveedorModel();
            $data['proveedores'] = $proveedoresModel->getAll();
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data['errores'] = $errores;            

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.producto.view.php', 'templates/footer.view.php'), $data);
        }
        else{
            //Procesar el alta
            $modelo = new \CodeShred\Models\ProductoModel();            
            if($modelo->insertProducto($_POST)){
                header('location: /productos');
            }
            else{
                $data = [];
                $data['titulo'] = 'Insertar producto';
                $data['seccion'] = '/productos/add';
                $data['tituloDiv'] = 'Alta producto';

                $categoriaModel = new \CodeShred\Models\CategoriaModel();
                $data['categorias'] = $categoriaModel->getAllCategorias();
                $data['ivas'] = self::IVAS;
                //var_dump($data['categorias']); die();

                $proveedoresModel = new \CodeShred\Models\ProveedorModel();
                $data['proveedores'] = $proveedoresModel->getAll();
                $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                $data['errores'] = ['codigo' => 'Error indeterminado al realizar el guardado'];            

                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.code-fragments.view.php', 'templates/footer.view.php'), $data);
            }
        }
    }
    
    function processEdit(){
        $errores = $this->checkForm($_POST, false);
        $modelo = new \CodeShred\Models\ProductoModel();            
        if(count($errores) > 0){
            
            $data = [];
            $data['titulo'] = 'Editando producto: '. $_POST['codigo'];
            $data['tituloDiv'] = 'Modificar producto';
            $data['seccion'] = '/productos/edit';

            $categoriaModel = new \CodeShred\Models\CategoriaModel();
            $data['categorias'] = $categoriaModel->getAllCategorias();
            $data['ivas'] = self::IVAS;
            //var_dump($data['categorias']); die();

            $proveedoresModel = new \CodeShred\Models\ProveedorModel();
            $data['proveedores'] = $proveedoresModel->getAll();
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data['errores'] = $errores;            

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.code-fragments.view.php', 'templates/footer.view.php'), $data);
        }
        else{
            //Procesar el alta
            $modelo = new \CodeShred\Models\ProductoModel();
            $saneado = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            if($modelo->updateProducto($saneado)){
                header('location: /productos');
            }
            else{
                $data = [];
                $data['titulo'] = 'Editando producto: '. $_POST['codigo'];
                $data['tituloDiv'] = 'Modificar producto';
                $data['seccion'] = '/productos/edit';

                $categoriaModel = new \CodeShred\Models\CategoriaModel();
                $data['categorias'] = $categoriaModel->getAllCategorias();
                $data['ivas'] = self::IVAS;
                //var_dump($data['categorias']); die();

                $proveedoresModel = new \CodeShred\Models\ProveedorModel();
                $data['proveedores'] = $proveedoresModel->getAll();
                $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                $data['errores'] = ['codigo' => 'Error indeterminado al realizar el guardado'];            

                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'edit.code-fragments.view.php', 'templates/footer.view.php'), $data);
            }
        }
    }
    
    private function checkForm(array $post, bool $alta = true){
        $errores = [];
        if($post['codigo'] == ''){
            $errores['codigo'] = 'Inserte un código';
        }
        else if(strlen($post['codigo']) > 10){
            $errores['codigo'] = 'El código debe tener una longitud máxima de 10 caracteres';
        }
        else if($alta){
            $modelo = new \CodeShred\Models\ProductoModel();
            $row = $modelo->loadProducto($post['codigo']);
            if(!is_null($row)){
                $errores['codigo'] = 'El código ya está en uso por otro producto.';
            }
        }
        //Es una modificación
        else{
            $modelo = new \CodeShred\Models\ProductoModel();
            $row = $modelo->loadProducto($post['codigo']);
            if(is_null($row)){
                $errores['codigo'] = 'No se encuentra en base de datos el producto que se desea editar.';
            }
        }
        
        if(strlen($post['nombre']) == 0){
            $errores['nombre'] = 'Debe insertar un nombre de producto.';
        }        
        
        if($post['id_categoria'] == ''){
            $errores['id_categoria'] = 'Seleccione una categoría';
        }
        else if(!is_numeric($post['id_categoria'])){
            $errores['id_categoria'] = 'Categoría seleccionada inválida.';
        }
        else{
            $categoriaModel = new \CodeShred\Models\CategoriaModel();
            $categoriaRow = $categoriaModel->loadCategoria((int)$post['id_categoria']);
            if(is_null($categoriaRow)){
                $errores['id_categoria'] = 'La categoría seleccionada no existe.';
            }
        }
        
        if($post['proveedor'] == ''){
            $errores['proveedor'] = 'Debe seleccionar un proveedor.';
        }
        else{
            $proveedorModel = new \CodeShred\Models\ProveedorModel();
            $proveedorRow = $proveedorModel->loadProveedor($post['proveedor']);
            if(is_null($proveedorRow)){
                $errores['proveedor'] = 'El proveedor seleccionado no existe.';
            }
        }
        
        $numericos = ['coste', 'margen', 'stock'];
        
        foreach($numericos as $variable){
            if(!is_numeric($post[$variable])){
                $errores[$variable] = "Por favor inserte un número.";
            }
            else if($post[$variable] <= 0){
                $errores[$variable] = "El campo $variable debe tener un valor mayor que cero.";
            }
        }
         
        if($post['iva'] == ''){
            $errores['iva'] = 'Seleccione un IVA';
        }
        else if(!in_array($post['iva'], self::IVAS)){
            $errores['iva'] = 'El iva puede tener los siguientes valores: '.implode(",", self::IVAS);
        }
        return $errores;
    }
    
    public function delete(string $codigo){
        $modelo = new \CodeShred\Models\ProductoModel();
        if($modelo->deleteProducto($codigo)){
            $_SESSION['mensaje_productos'] = array(
                'class' => 'success',
                'texto' => "Producto $codigo eliminado con éxito");
        }
        else{
            $_SESSION['mensaje_productos'] = array(
                'class' => 'danger',
                'texto' => 'No se ha logrado eliminar el producto '.$codigo);
        }
        header('location: /productos');
    }
}