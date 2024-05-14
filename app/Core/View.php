<?php

namespace CodeShred\Core;

class View {

    private $controller;

    /**
     * Constructor de la clase View.
     * 
     * @param string $controller Controlador de la vista.
     */
    public function __construct(string $controller) {
        $this->controller = $controller;
    }

    /**
     * Método que enseña una vista del sistema pasada como parámetro.
     * 
     * @param string $name Nombre de la vista a enseñar.
     * @param type $vars Variables que pasar a la vista.
     * @throws \Exception Excepción que lanza si no existe la plantilla.
     */
    public function show(string $name, $vars = array()) {
        // Cogemos una instancia de nuestra clase de configuracion.    
        // Creamos la ruta real a la plantilla
        $path = $_ENV['folder.views'] . $name;

        // Si no existe el fichero en cuestion, lanzamos una excepción
        if (file_exists($path) == false) {
            throw new \Exception('La plantilla ' . $path . ' no existe');
        }

        // Si hay variables para asignar, las pasamos una a una.
        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $$key = $value;
            }
        }

        // Necesario para saber en la vista qué controlador hemos cargado y así 
        // por ejemplo marcar en la barra izquierda la sección en la que estamos
        $controller = $this->controller;

        // Finalmente, incluimos la plantilla.
        include($path);
    }

    /**
     * Método que enseña las vistas del sistema pasadas como parámetro.
     * 
     * @param array $views Colección de nombres de las vistas a enseñar.
     * @param type $data Datos que pasar a las vistas.
     * @throws \Exception Excepción que lanza si no existe una plantilla.
     */
    public function showViews(array $views, $data = array()) {
        foreach ($views as $viewPath) {
            // Creamos la ruta real a la plantilla
            $path = $_ENV['folder.views'] . $viewPath;

            // Si no existe el fichero en cuestion, lanzamos una excepción
            if (file_exists($path) == false) {
                throw new \Exception('La plantilla ' . $path . ' no existe');
            }
        }

        // Si hay variables para asignar, las pasamos una a una.
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        // Necesario para saber en la vista qué controlador hemos cargado y así 
        // por ejemplo marcar en la barra izquierda la sección en la que estamos
        $controller = $this->controller;

        // Enseñamos las vistas
        foreach ($views as $viewPath) {
            $path = $_ENV['folder.views'] . $viewPath;
            // Incluimos cada plantilla.
            include($path);
        }
    }
}
