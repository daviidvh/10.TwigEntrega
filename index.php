<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './db/Database.php';


// Insertamos las dependencias del proyecto
require_once './vendor/autoload.php';
require_once 'Router.php';

require_once './controller/IndexController.php';
require_once './controller/PedidosController.php';
require_once './controller/ClientesController.php';
require_once './controller/ProductosController.php';
require_once './controller/EstadosController.php';

$database = new Database ('root', '', 'localhost', 3306);
$dbConex= $database->conectar();
// Database::iniciarTablas($dbConex);
Database::desconectar();



$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('URL', $_SERVER['REQUEST_URI']);

$route = new Router();
$route->get('/',[IndexController::class,'index'])

->get('/index-clientes',[ClientesController::class,'index'])


->get('/index-estados',[EstadosController::class,'index'])


->get('/index-productos',[ProductosController::class,'index'])
->get('/pedidos-usuarios',[PedidosController::class,'pedidosUsuario'])
->get('/index-pedidos',[PedidosController::class,'index'])
->get('/index-pedidos-precioDESC',[PedidosController::class,'indexPrecioMayor'])
->get('/index-pedidos-precioASC',[PedidosController::class,'indexPrecioMenor'])
->get('/index-pedidos-cantidadASC',[PedidosController::class,'indexCantidadMenor'])
->get('/index-pedidos-cantidadDESC',[PedidosController::class,'indexCantidadMayor'])
->get('/editar-pedido',[PedidosController::class,'edit'])
->post('/pedido-editado',[PedidosController::class,'update'])
->get('/eliminar-producto-pedido',[PedidosController::class,'destroyProductoPedido'])
->get('/eliminar-pedido',[PedidosController::class,'destroy'])




->get('/index-productos',[ProductosController::class,'index'])
->get('/buscar-producto',[ProductosController::class,'buscar'])
->post('/producto-editado',[ProductosController::class,'update'])
->get('/agregar-producto',[ProductosController::class,'create'])
->post('/guardar-producto',[ProductosController::class,'save'])
->get('/eliminar-producto',[ProductosController::class,'destroy'])

->get('/agregar-estado',[EstadosController::class,'create'])


->get('/editar-producto',[ProductosController::class,'edit'])
->get('/editar-unproducto',[ProductosController::class,'editOne']);

    
    

$route->resolver_ruta($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>