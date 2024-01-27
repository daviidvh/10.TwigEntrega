
<?php
    require_once 'model/Cliente.php';

class ClientesController{

/**
     * Muestra la página principal de clientes.
     *
     * Este método se encarga de obtener todos los clientes desde la base de datos
     * y renderizar la plantilla de la página de clientes.
     *
     * @return void
    */
public static function index(){
    $cliente = new Cliente();
    $clientes = $cliente->findAll()->fetchAll();
        echo $GLOBALS['twig']->render('clientes/index.twig',
        [
            'clientes' => $clientes
        ]);
    }
}