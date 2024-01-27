<?php
require_once 'db/Database.php';
require_once 'model/Model.php';

class Producto implements Model
{

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;
        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     */
    public function setStock($stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * Recupera todos los productos de la base de datos.
     *
     * @return PDOStatement - La declaración PDO que contiene todos los productos.
     */
    public function findAll(): PDOStatement{
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        $query = "  SELECT * 
                   FROM productos
           ";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;
    }

    /**
     * Busca productos por nombre en la base de datos.
     *
     * @param string $nombre - El nombre del producto a buscar.
     * @return PDOStatement - La declaración PDO que contiene los resultados de la consulta.
     */
    public function findByName($nombre): PDOStatement{
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        $query = "  SELECT * 
               FROM productos
                WHERE nombre='$nombre'";


        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;
    }

    /**
     * Recupera un pedido y sus productos asociados según el ID proporcionado.
     *
     * @param int $id - El ID del pedido que se desea recuperar.
     * @return PDOStatement - La declaración PDO que contiene el pedido y sus productos asociados.
     */
    public function findById($id): PDOStatement{
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        $query = "SELECT pedidos.*, productos.*
          FROM pedidos
          INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
          INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
          WHERE pedidos.id = $id";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;
    }
    
    /**
     * Recupera un producto según el ID proporcionado.
     *
     * @param int $id - El ID del producto que se desea recuperar.
     * @return PDOStatement - La declaración PDO que contiene la información del producto.
     */
    public function findByIdOne($id): PDOStatement{
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        $query = "SELECT *
          FROM productos
          WHERE id = $id";

        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;
    }

    /**
     * Actualiza la información de un producto según el ID proporcionado.
     *
     * @param int $id - El ID del producto que se desea actualizar.
     */
    public function updateById($id){
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];


        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        $query = "
        UPDATE productos
        SET nombre = '$nombre', 
            descripcion = '$descripcion', 
            precio = '$precio', 
            stock = $stock
        WHERE id = $id;
    ";
        $result = $db->query($query);

        $db = $database->desconectar();
    }
    /**
     * Almacena un nuevo producto en la base de datos.
     *
     * @param array $datos - Un array asociativo con los datos del nuevo producto.
     */
    public function store($datos){
        $query = "INSERT INTO productos (" . implode(",", array_keys($datos)) . ")VALUES ('" . implode("','", array_values($datos)) . "')";
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        $db->exec($query);
        $db = $database->desconectar();
    }

    /**
     * Elimina un producto de la base de datos por su ID.
     *
     * @param int $id - ID del producto que se eliminará.
     */
    public function destroyById($id){

        $database = new Database('root', '', 'localhost', 3306);
        $query = "DELETE FROM productos WHERE id = $id";
        $db = $database->conectar();
        $db->exec($query);
        $db = $database->desconectar();
    }
}
