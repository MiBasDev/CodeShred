<?php

declare(strict_types=1);

namespace CodeShred\Core;

use \PDO;

class DBManager {

    // Contenedor de la instancia de la Clase
    private static $instance;
    private $db;

    /**
     * Contructor vacío de la clase DBManager.
     * 
     * Previene la creación de una instancia de la clase con new.
     */
    private function __construct() {
        
    }

    /**
     * Método que devuelve el singleton de la clase DBManager.
     * 
     * @return type Instancia de la clase DBManager.
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Método para crear un singleton.
     * 
     * @param type $emulatePrepares Indica si se deben emular las sentencias preparadas (por defecto es falso).
     * @return type instancia de la DB.
     * @throws \PDOException Excepción que lanza si no se crea una instancia de la DB.
     */
    public function getConnection($emulatePrepares = false) {
        if (is_null($this->db)) {
            $host = $_ENV['db.host'];
            $db = $_ENV['db.schema'];
            $user = $_ENV['db.user'];
            $pass = $_ENV['db.pass'];
            $charset = $_ENV['db.charset'];
            $emulated = (bool) $_ENV['db.emulated'];

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => $emulated,
            ];
            try {
                $this->db = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
        return $this->db;
    }
}
