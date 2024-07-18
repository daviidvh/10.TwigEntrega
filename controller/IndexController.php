<?php
class IndexController{

    /**
     * Muestra la página principal.
     *
     * Este método se encarga de renderizar la plantilla 'index.twig'
     * utilizando el motor de plantillas Twig y mostrarla en el navegador.
     *
     * @return void No devuelve un valor explícito.
     */
    public static function index(){

        echo $GLOBALS['twig']->render('index.twig');

    }
}

?>