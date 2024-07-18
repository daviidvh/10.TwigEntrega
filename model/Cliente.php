<?php
require_once 'db/Database.php';

class Cliente{
    private $id;
    private $dni;
    private $nombre;
    private $apellido;
    private $correo;
    private $direccion;

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of dni
     */
    public function getDni() {
        return $this->dni;
    }

    /**
     * Set the value of dni
     */
    public function setDni($dni): self {
        $this->dni = $dni;
        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     */
    public function setApellido($apellido): self {
        $this->apellido = $apellido;
        return $this;
    }

    /**
     * Get the value of correo
     */
    public function getCorreo() {
        return $this->correo;
    }

    /**
     * Set the value of correo
     */
    public function setCorreo($correo): self {
        $this->correo = $correo;
        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     */
    public function setDireccion($direccion): self {
        $this->direccion = $direccion;
        return $this;
    }

    /**
    * Obtener todos los clientes de la base de datos.
    *
    * @return PDOStatement La declaración PDO con los resultados de la consulta.
    */
    public function findAll() : PDOStatement{
         $database = new Database ('root', '', 'localhost', 3306);
         $db= $database->conectar();
         $query = "  SELECT * FROM clientes";
         $result = $db->query($query);
         $db = $database->desconectar();
         return $result;     

    }

}
