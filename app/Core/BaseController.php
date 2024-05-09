<?php

namespace CodeShred\Core;

abstract class BaseController {

    // Hace referencia a la vista de una página
    protected $view;

    /**
     * Constructor de la clase BaseController
     */
    function __construct() {
        $this->view = new View(get_class($this));
    }
}
