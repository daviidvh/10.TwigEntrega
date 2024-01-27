<?php
require_once 'db/Database.php';

class Estado{
    private $id;
    private $nombre;

    


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
    * Obtener todos los estados de la base de datos.
    *
    * @return PDOStatement La declaración PDO con los resultados de la consulta.
    */
    public  function findAll(){
        $database = new Database ('root', '', 'localhost', 3306);
        $db= $database->conectar();
        $query = "  SELECT * FROM estado";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;     

    }
    /**
     * Crea una nueva entrada en la tabla 'pedido_has_estado'.
     *
     * @param int $idEstado - El ID del estado que se asignará al pedido.
     * @param int $idPedido - El ID del pedido al que se le asignará el estado.
     * @return bool - Devuelve true si la operación fue exitosa, false en caso contrario.
     */
    public  function create($idEstado, $idPedido){
        $database = new Database ('root', '', 'localhost', 3306);
        $db= $database->conectar();
        $query = "INSERT INTO pedido_has_estado (id_pedido, id_estado, fecha) VALUES ($idPedido, $idEstado,CURRENT_TIMESTAMP)";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;     

    }
}