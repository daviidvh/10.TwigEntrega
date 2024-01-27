<?php

require_once 'db/Database.php';

class Pedidos
{
    private $id;
    private $fecha;
    private $id_cliente;
    private $direccion_entrega;
    private $total;


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
     * Get the value of fecha
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self {
        $this->fecha = $fecha;
        return $this;
    }

    /**
     * Get the value of id_cliente
     */
    public function getIdCliente() {
        return $this->id_cliente;
    }

    /**
     * Set the value of id_cliente
     */
    public function setIdCliente($id_cliente): self {
        $this->id_cliente = $id_cliente;
        return $this;
    }

    /**
     * Get the value of direccion_entrega
     */
    public function getDireccionEntrega() {
        return $this->direccion_entrega;
    }

    /**
     * Set the value of direccion_entrega
     */
    public function setDireccionEntrega($direccion_entrega): self {
        $this->direccion_entrega = $direccion_entrega;
        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self {
        $this->total = $total;
        return $this;
    }

    /**
     * Obtiene todos los registros de la tabla 'pedidos' con información adicional de clientes, productos y pedidos_has_productos.
     *
     * @return PDOStatement - Una declaración preparada que contiene el resultado de la consulta.
     */
    public function findAll() : PDOStatement{
         $database = new Database ('root', '', 'localhost', 3306);
         $db= $database->conectar();
         $query = "  SELECT 
                     pedidos.id , 
                        pedidos.fecha, 
                        clientes.nombre AS cliente_nombre, 
                        pedidos.direccion_entrega, 
                        pedidos.total,
                        productos.precio,
                        productos.nombre AS producto_nombre,
                        pedidos_has_productos.id_producto,
                        pedidos_has_productos.cantidad
                    FROM pedidos
                    INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                    INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                    INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
            ";
         $result = $db->query($query);
         $db = $database->desconectar();
         return $result;     

    }

    /**
     * Obtiene todos los registros de la tabla 'pedidos' con información adicional de clientes, productos y pedidos_has_productos, filtrados por un ID y ordenados por precio de productos de forma descendente.
     *
     * @param int $id - El ID para filtrar los resultados.
     * @return PDOStatement - Una declaración preparada que contiene el resultado de la consulta.
     */
    public function findAllPrecioMayor($id) : PDOStatement{
         $database = new Database ('root', '', 'localhost', 3306);
         $db= $database->conectar();
         $query = "  SELECT 
                     pedidos.id , 
                        pedidos.fecha, 
                        clientes.nombre AS cliente_nombre, 
                        pedidos.direccion_entrega, 
                        pedidos.total,
                        productos.precio,
                        productos.nombre AS producto_nombre,
                        pedidos_has_productos.id_producto,
                        pedidos_has_productos.cantidad
                    FROM pedidos
                    INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                    INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                    INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
                    WHERE pedidos.id = $id
                    ORDER BY productos.precio DESC 
                    ";
         $result = $db->query($query);
         $db = $database->desconectar();
         return $result;     
    }


    public function findAllPrecioMenor($id) : PDOStatement{
         $database = new Database ('root', '', 'localhost', 3306);
         $db= $database->conectar();
         $query = "  SELECT 
                     pedidos.id , 
                        pedidos.fecha, 
                        clientes.nombre AS cliente_nombre, 
                        pedidos.direccion_entrega, 
                        pedidos.total,
                        productos.precio,
                        productos.nombre AS producto_nombre,
                        pedidos_has_productos.id_producto,
                        pedidos_has_productos.cantidad
                    FROM pedidos
                    INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                    INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                    INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
                    WHERE pedidos.id = $id
                    ORDER BY productos.precio ASC
                    ";
         $result = $db->query($query);
         $db = $database->desconectar();
         return $result;     
    }


    /**
     * Obtiene todos los registros de la tabla 'pedidos' con información adicional de clientes, productos y pedidos_has_productos, filtrados por un ID y ordenados por precio de productos de forma ascendente.
     *
     * @param int $id - El ID para filtrar los resultados.
     * @return PDOStatement - Una declaración preparada que contiene el resultado de la consulta.
     */
    public function findAllCantidadMayor($id) : PDOStatement{
         $database = new Database ('root', '', 'localhost', 3306);
         $db= $database->conectar();
         $query = "  SELECT 
                        pedidos.id , 
                        pedidos.fecha, 
                        clientes.nombre AS cliente_nombre, 
                        pedidos.direccion_entrega, 
                        pedidos.total,
                        productos.precio,
                        productos.nombre AS producto_nombre,
                        pedidos_has_productos.id_producto,
                        pedidos_has_productos.cantidad
                    FROM pedidos
                    INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                    INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                    INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
                    WHERE pedidos.id = $id
                    ORDER BY pedidos_has_productos.cantidad DESC
                    ";
         $result = $db->query($query);
         $db = $database->desconectar();
         return $result;     
    }


    public function findAllCantidadMenor($id) : PDOStatement{
         $database = new Database ('root', '', 'localhost', 3306);
         $db= $database->conectar();
         $query = "  SELECT 
                     pedidos.id , 
                        pedidos.fecha, 
                        clientes.nombre AS cliente_nombre, 
                        pedidos.direccion_entrega, 
                        pedidos.total,
                        productos.precio,
                        productos.nombre AS producto_nombre,
                        pedidos_has_productos.id_producto,
                        pedidos_has_productos.cantidad
                    FROM pedidos
                    INNER JOIN clientes ON pedidos.id_cliente = clientes.id
                    INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
                    INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
                    WHERE pedidos.id = $id
                    ORDER BY pedidos_has_productos.cantidad ASC
                    ";
         $result = $db->query($query);
         $db = $database->desconectar();
         return $result;     
    }

    /**
     * Obtiene todos los registros de la tabla 'pedidos' con información adicional de clientes, productos y pedidos_has_productos, filtrados por un ID y ordenados por cantidad de productos de forma ascendente.
     *
     * @param int $id - El ID para filtrar los resultados.
     * @return PDOStatement - Una declaración preparada que contiene el resultado de la consulta.
     */
    public function findById($id){
        $database = new Database ('root', '', 'localhost', 3306);
        $db= $database->conectar();
        $query = "SELECT 
                  pedidos.id AS pedido_id, 
                  pedidos.fecha, 
                  clientes.nombre AS cliente_nombre,
                  clientes.apellido ,
                  clientes.correo AS email, 
                  pedidos.direccion_entrega AS direccion, 
                  pedidos.total AS totalCompra,
                  productos.precio,
                  productos.id AS producto_id,
                  productos.nombre AS producto,
                  pedidos_has_productos.cantidad
              FROM pedidos
              INNER JOIN clientes ON pedidos.id_cliente = clientes.id
              INNER JOIN pedidos_has_productos ON pedidos.id = pedidos_has_productos.id_pedido
              INNER JOIN productos ON pedidos_has_productos.id_producto = productos.id
             WHERE id_cliente = $id";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;     

    }

    /**
     * Obtiene información sobre el estado de los pedidos, incluyendo el ID del pedido, nombre del estado, fecha y ID del estado.
     *
     * @return PDOStatement - Una declaración preparada que contiene el resultado de la consulta.
     */
    public function findEstados(){
        $database = new Database ('root', '', 'localhost', 3306);
        $db= $database->conectar();
        $query = " SELECT 
                pedidos.id AS pedido_id, 
                estado.nombre AS estado_pedido,
                pedido_has_estado.fecha AS fecha,
                pedido_has_estado.id_estado AS estadoId
            FROM pedidos
            INNER JOIN pedido_has_estado ON pedidos.id = pedido_has_estado.id_pedido
            INNER JOIN estado ON pedido_has_estado.id_estado = estado.id
            ORDER BY fecha ASC";
        $result = $db->query($query);
        $db = $database->desconectar();
        return $result;     

    }


    public function store($datos){

    }

    
    /**
     * Actualiza la información de un producto en un pedido específico mediante sus IDs.
     *
     * @param int $idPedido - El ID del pedido.
     * @param int $idProducto - El ID del producto en el pedido.
     */
    public function updateById($idPedido, $idProducto){
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $direccion = $_POST['direccion'];


        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        
        $query = "UPDATE pedidos_has_productos
        JOIN productos ON pedidos_has_productos.id_producto = productos.id
        JOIN pedidos ON pedidos_has_productos.id_pedido = pedidos.id
        SET
            productos.nombre = '$nombre',
            pedidos_has_productos.cantidad = $cantidad,
            pedidos.direccion_entrega = '$direccion'
        WHERE pedidos_has_productos.id_pedido = $idPedido AND pedidos_has_productos.id_producto = $idProducto
    ";

        $db->query($query);

        $db = $database->desconectar();
    }

    /**
    * Elimina un pedido y sus productos asociados mediante el ID del pedido.
    *
    * @param int $id - El ID del pedido a eliminar.
    */
    public function destroyById($id){
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        
        $query1 = "DELETE FROM pedidos_has_productos WHERE id_pedido = $id";
        $db->query($query1);
        
        $query2 = "DELETE FROM pedidos WHERE id = $id";
        $db->query($query2);

        $db = $database->desconectar();
    }

    /**
    * Elimina un producto asociado a un pedido mediante los IDs del pedido y del producto.
    *
    * @param int $idPedido - El ID del pedido.
    * @param int $idProducto - El ID del producto.
    */
    public function destroyProductoPedido($idPedido, $idProducto){
        $database = new Database('root', '', 'localhost', 3306);
        $db = $database->conectar();
        
        $query = "DELETE FROM pedidos_has_productos WHERE id_pedido = $idPedido AND id_producto = $idProducto";

        $db->query($query);

        $db = $database->desconectar();
    }

}


?>