<?php
    require_once 'controller/Controller.php';
    require_once 'model/Producto.php';

class ProductosController implements Controller{


   /**
     * Muestra todos los productos.
     *
     * Este método obtiene todos los productos utilizando la función 'findAll'
     * de la clase Producto. Luego, renderiza la vista 'productos/index.twig'
     * con la lista de productos obtenida y la envía como datos a la vista.
     *
     * @return void No devuelve un valor explícito.
     */
    public static function index(){

        $producto = new Producto();
        $productos = $producto->findAll()->fetchAll();
            echo $GLOBALS['twig']->render('productos/index.twig',
            [
                'productos' => $productos
            ]);
        
    }

   /**
     * Buscar productos por nombre.
     *
     * Este método obtiene el nombre del producto a buscar mediante la variable GET.
     * Luego, utiliza la función 'findByName' de la clase Producto para buscar productos
     * que coincidan con el nombre proporcionado. Finalmente, renderiza la vista 'productos/busqueda.twig'
     * con la lista de productos obtenida y la envía como datos a la vista.
     *
     * @return void No devuelve un valor explícito.
     */
    public static function buscar(){
        $nombre=$_GET['nombre'];
        $producto = new Producto();
        $productos = $producto->findByName($nombre)->fetchAll();
            echo $GLOBALS['twig']->render('productos/busqueda.twig',
            [
                'productos' => $productos
            ]);
    }

 
   /**
     * Renderizar la vista para la creación de productos.
     *
     * Este método simplemente renderiza la vista 'productos/crear.twig'
     * para mostrar el formulario de creación de productos.
     *
     * @return void No devuelve un valor explícito.
     */
    public static function create(){

        echo $GLOBALS['twig']->render('productos/crear.twig');
    
    }

    /**
     * Guardar los datos del formulario de creación de productos.
     *
     * Este método recoge los datos del formulario, los valida y luego los
     * envía al modelo correspondiente para su almacenamiento.
     * Finalmente, redirige a la página 'index-productos'.
     *
     * @return void No devuelve un valor explícito.
     */
    public static function save(){
          $datos = array();
      if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
         $datos['nombre'] = $_POST['nombre'];
      }
      if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
         $datos['descripcion'] = $_POST['descripcion'];
      }
      if (isset($_POST['precio']) && !empty($_POST['precio'])) {
         $datos['precio'] = $_POST['precio'];
      }
      if (isset($_POST['stock']) && !empty($_POST['stock'])) {
         $datos['stock'] = $_POST['stock'];
      }

      $producto = new Producto();
      $producto->store($datos);

      header('Location: index-productos');
    }

   /**
     * Mostrar el formulario de edición de un producto específico.
     *
     * Este método recoge el ID del producto a editar, consulta la información
     * correspondiente en el modelo y luego muestra el formulario de edición.
     *
     * @param int $id El ID del producto a editar.
     * @return void No devuelve un valor explícito.
     */
    public static function edit($id){
        $id=$_GET['id'];
        $producto = new Producto();
        $productos = $producto->findById($id)->fetchAll();
            echo $GLOBALS['twig']->render('productos/edit.twig',
            [
                'productos' => $productos
            ]);
    }
    

    /**
     * Mostrar el formulario de edición de un solo producto.
     *
     * Este método recoge el ID del producto a editar, consulta la información
     * correspondiente en el modelo y luego muestra el formulario de edición.
     *
     * @param int $id El ID del producto a editar.
     * @return void No devuelve un valor explícito.
     */
    public static function editOne($id){
        $id=$_GET['id'];
        $producto = new Producto();
        $productos = $producto->findByIdOne($id)->fetchAll();
            echo $GLOBALS['twig']->render('productos/editOne.twig',
            [
                'productos' => $productos
            ]);
    }

    /**
     * Actualizar la información de un producto.
     *
     * Este método recibe el ID del producto a actualizar, recoge los datos
     * del formulario de edición, actualiza la información en el modelo y
     * redirige a la página de índice de productos.
     *
     * @param int $id El ID del producto a actualizar.
     * @return void No devuelve un valor explícito.
     */
    public static function update($id){
        $id=$_GET['id'];
        $producto = new Producto();
         $productos=$producto->updateById($id);
         
         header('Location: index-productos');
    }

    /**
     * Eliminar un producto por su ID.
     *
     * Este método recibe el ID del producto a eliminar, realiza la operación
     * en el modelo y redirige a la página de índice de productos.
     *
     * @param int $id El ID del producto a eliminar.
     * @return void No devuelve un valor explícito.
     */
    public static function destroy($id){
        $id=$_GET['id'];
        $producto = new Producto();
         $productos=$producto->destroyById($id);
         header('Location: index-productos');

    }
}

?>