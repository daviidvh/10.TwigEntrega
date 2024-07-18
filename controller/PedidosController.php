<?php
    require_once 'controller/Controller.php';
    require_once 'model/Pedidos.php';

    class PedidosController implements Controller{

        /**
         * Muestra la página de pedidos con información agrupada.
         *
         * Este método obtiene todos los pedidos, los agrupa por su 'id',
         * y luego renderiza la plantilla 'pedidos/index.twig' utilizando
         * el motor de plantillas Twig, pasando los pedidos agrupados y
         * otros datos relevantes.
         *
         * @return void No devuelve un valor explícito.
         */

        public static function index(){
            $pedido = new Pedidos();
            $pedidos = $pedido->findAll()->fetchAll();
    
            // Crear un array para agrupar los pedidos por su id
            $grupoPedidos = [];

            // Iterar sobre cada pedido en el array $pedidos
            foreach ($pedidos as $pedido) {
                // Usar el 'id' del pedido como clave en $grupoPedidos
                // y agregar el pedido al grupo correspondiente
                $grupoPedidos[$pedido['id']][] = $pedido;
            }
            $pedidoEstado = new Pedidos();
            $pedidoEstados = $pedidoEstado->findEstados()->fetchAll();
            $estados = new Estado();
            $estados = $estados->findAll()->fetchAll();
            // Renderizar la vista con los pedidos agrupados
            echo $GLOBALS['twig']->render('pedidos/index.twig', [
                'pedidos' => $grupoPedidos,
                'pedidoEstados' => $pedidoEstados,
                'estados' => $estados

            ]);
        }
       /**
         * Muestra la página de pedidos con información agrupada
         * para los pedidos con precio mayor a cierto valor.
         *
         * Este método obtiene los pedidos con un precio mayor al
         * valor proporcionado, los agrupa por su 'id' y luego
         * renderiza la plantilla 'pedidos/index.twig' utilizando
         * el motor de plantillas Twig, pasando los pedidos agrupados.
         *
         * @return void No devuelve un valor explícito.
         */

        public static function indexPrecioMayor(){
            $id=$_GET['id'];

            $pedido = new Pedidos();
            $pedidos = $pedido->findAllPrecioMayor($id)->fetchAll();
    
            $grupoPedidos = [];
                    
            foreach ($pedidos as $pedido) {
                $grupoPedidos[$pedido['id']][] = $pedido;
            }

            echo $GLOBALS['twig']->render('pedidos/index.twig', [
                'pedidos' => $grupoPedidos,
            ]);
        }

     /**
       * Muestra la página de pedidos con información agrupada
       * para los pedidos con precio menor a cierto valor.
       *
       * Este método obtiene los pedidos con un precio menor al
       * valor proporcionado, los agrupa por su 'id' y luego
       * renderiza la plantilla 'pedidos/index.twig' utilizando
       * el motor de plantillas Twig, pasando los pedidos agrupados.
       *
       * @return void No devuelve un valor explícito.
       */
        public static function indexPrecioMenor(){
            $id=$_GET['id'];

            $pedido = new Pedidos();
            $pedidos = $pedido->findAllPrecioMenor($id)->fetchAll();
    
            $grupoPedidos = [];
                    
            foreach ($pedidos as $pedido) {
                $grupoPedidos[$pedido['id']][] = $pedido;
            }
    
            echo $GLOBALS['twig']->render('pedidos/index.twig', [
                'pedidos' => $grupoPedidos,
            ]);
        }


    /**
      * Muestra la página de pedidos con información agrupada
      * para los pedidos con cantidad mayor a cierto valor.
      *
      * Este método obtiene los pedidos con una cantidad mayor al
      * valor proporcionado, los agrupa por su 'id' y luego
      * renderiza la plantilla 'pedidos/index.twig' utilizando
      * el motor de plantillas Twig, pasando los pedidos agrupados.
      *
      * @return void No devuelve un valor explícito.
      */
        public static function indexCantidadMayor(){
            $id=$_GET['id'];

            $pedido = new Pedidos();
            $pedidos = $pedido->findAllCantidadMayor($id)->fetchAll();
    
            $grupoPedidos = [];
                    
            foreach ($pedidos as $pedido) {
                $grupoPedidos[$pedido['id']][] = $pedido;
            }

            echo $GLOBALS['twig']->render('pedidos/index.twig', [
                'pedidos' => $grupoPedidos,
            ]);
        }

        public static function indexCantidadMenor(){
            $id=$_GET['id'];

            $pedido = new Pedidos();
            $pedidos = $pedido->findAllCantidadMenor($id)->fetchAll();
    
            $grupoPedidos = [];
                    
            foreach ($pedidos as $pedido) {
                $grupoPedidos[$pedido['id']][] = $pedido;
            }

            echo $GLOBALS['twig']->render('pedidos/index.twig', [
                'pedidos' => $grupoPedidos,
            ]);
        }


   /**
     * Muestra la página de pedidos con información agrupada
     * para los pedidos con cantidad menor a cierto valor.
     *
     * Este método obtiene los pedidos con una cantidad menor al
     * valor proporcionado, los agrupa por su 'id' y luego
     * renderiza la plantilla 'pedidos/index.twig' utilizando
     * el motor de plantillas Twig, pasando los pedidos agrupados.
     *
     * @return void No devuelve un valor explícito.
     */
       public static function pedidosUsuario($id){
        $id=$_GET['id'];
        $pedidoCliente = new Pedidos();
        $pedidoClientes = $pedidoCliente->findById($id)->fetchAll();
        
        $pedidoEstado = new Pedidos();
        $pedidoEstados = $pedidoEstado->findEstados()->fetchAll();
            echo $GLOBALS['twig']->render('pedidos/pedidosUser.twig',
            [
                'pedidoClientes' => $pedidoClientes,
                'pedidoEstados' => $pedidoEstados
            ]);
                
    }



    public static function create(){

    }

    public static function save(){

    }

    public static function edit($id){
        $id=$_GET['id'];
        $pedidoCliente = new Pedidos();
        $pedidoClientes = $pedidoCliente->findById($id)->fetchAll();
        echo $GLOBALS['twig']->render('pedidos/editar.twig',
        [
            'pedidoClientes' => $pedidoClientes,
        ]);
    }

   /**
     * Muestra la página de edición de un pedido.
     *
     * Este método obtiene el 'id' del pedido desde la URL,
     * busca el pedido correspondiente en la base de datos,
     * y luego renderiza la plantilla 'pedidos/editar.twig'
     * utilizando el motor de plantillas Twig, pasando la
     * información del pedido a la vista.
     *
     * @param int $id El 'id' del pedido a editar.
     * @return void No devuelve un valor explícito.
     */
    public static function update($id){
        $idPedido = $_GET['id_pedido'];
        $idProducto = $_GET['id_producto'];
        $pedido = new Pedidos();
         $pedidos=$pedido->updateById( $idPedido, $idProducto);
         
         header('Location: index-pedidos');

        }

    
   /**
     * Elimina un pedido según su 'id'.
     *
     * Este método obtiene el 'id' del pedido desde la URL,
     * llama a la función 'destroyById' de la clase Pedidos
     * para eliminar el pedido correspondiente en la base
     * de datos y luego redirige a la página principal de
     * pedidos ('index-pedidos').
     *
     * @param int $id El 'id' del pedido a eliminar.
     * @return void No devuelve un valor explícito.
     */
    public static function destroy($id){
        $id = $_GET['id'];
        $pedido = new Pedidos();
        $pedidos=$pedido->destroyById($id);
         
         header('Location: index-pedidos');
    }

   /**
     * Elimina un producto de un pedido según sus 'id_pedido' e 'id_producto'.
     *
     * Este método obtiene los 'id_pedido' e 'id_producto' desde la URL,
     * llama a la función 'destroyProductoPedido' de la clase Pedidos
     * para eliminar el producto del pedido correspondiente en la base
     * de datos y luego redirige a la página principal de pedidos ('index-pedidos').
     *
     * @param int $id El 'id' del producto a eliminar del pedido.
     * @return void No devuelve un valor explícito.
     */
    public static function destroyProductoPedido($id){
        $idPedido = $_GET['id_pedido'];
        $idProducto = $_GET['id_producto'];
        $pedido = new Pedidos();
        $pedidos=$pedido->destroyProductoPedido($idPedido, $idProducto);

         header('Location: index-pedidos');

    }
    }
?>