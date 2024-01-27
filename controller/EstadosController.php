
<?php
    require_once 'model/Estado.php';

class EstadosController{

    /**
     * Muestra la página principal de estados.
     *
     * Este método se encarga de obtener todos los estados desde la base de datos
     * y renderizar la plantilla de la página de estados.
     *
     * @return void No devuelve un valor explícito.
     */
    public static function index(){
        $estados = new Estado();
        $estados = $estados->findAll()->fetchAll();
            echo $GLOBALS['twig']->render('estados/index.twig',
            [
                'estados' => $estados
            ]);
        }

    /**
        * Crea un nuevo estado para un pedido específico.
        *
        * Este método se encarga de obtener los parámetros del estado y el pedido desde la URL,
        * crear un nuevo estado en la base de datos y redirigir a la página de pedidos.
        *
        * @return void No devuelve un valor explícito.
        */
        public static function create(){
            $idEstado=$_GET['idEstado'];
            $idPedido=$_GET['idPedido'];
            $estados = new Estado();
            $estados = $estados->create($idEstado, $idPedido)->fetchAll();
            
            header('Location: index-pedidos');
        }
            

}