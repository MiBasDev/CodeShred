<?php

namespace CodeShred\Core;

class View {

    private $controller;

    public function __construct(string $controller) {
        $this->controller = $controller;
    }

    public function show(string $name, $vars = array()) {
        //$name - nombre de nuestra plantilla, por ej, listar.php
        //$vars - contenedor de variables,
        //   es un array del tipo clave => valor (opcional).
        //Cogemos una instancia de nuestra clase de configuracion.        
        //Creamos la ruta real a la plantilla
        $path = $_ENV['folder.views'] . $name;

        //Si no existe el fichero en cuestion, lanzamos una excepción
        if (file_exists($path) == false) {
            throw new \Exception('La plantilla ' . $path . ' no existe');
        }

        //Si hay variables para asignar, las pasamos una a una.
        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $$key = $value;
            }
        }
        //Necesario para saber en la vista qué controlador hemos cargado y así por ejemplo marcar en la barra izquierda la sección en la que estamos
        $controller = $this->controller;
        //Finalmente, incluimos la plantilla.
        include($path);
    }

    public function showViews(array $views, $vars = array()) {
        //$name - nombre de nuestra plantilla, por ej, listar.php
        //$vars - contenedor de variables,
        //   es un array del tipo clave => valor (opcional).
        //Cogemos una instancia de nuestra clase de configuracion.        

        foreach ($views as $viewPath) {
            //Creamos la ruta real a la plantilla
            $path = $_ENV['folder.views'] . $viewPath;

            //Si no existe el fichero en cuestion, lanzamos una excepción
            if (file_exists($path) == false) {
                throw new \Exception('La plantilla ' . $path . ' no existe');
            }
        }

        //Si hay variables para asignar, las pasamos una a una.
        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $$key = $value;
            }
        }
        //Necesario para saber en la vista qué controlador hemos cargado y así por ejemplo marcar en la barra izquierda la sección en la que estamos
        $controller = $this->controller;
        foreach ($views as $viewPath) {
            $path = $_ENV['folder.views'] . $viewPath;
            //Finalmente, incluimos la plantilla.
            include($path);
        }
    }
}
