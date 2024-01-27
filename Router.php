<?php
    /**
     * En la clase Router se almacenan todas las rutas disponibles dentro de la aplicacion.
     * 
     * Cada ruta tiene asociado la funcion que se debe invocar en su clase correspondiente.
     * 
     * Las rutas las almacenamos en $rutas
     * 
     */

     class Router {

        # Este array contiene todas las rutas divididas por tipos
        /**
         * Rutas tipo GET
         * Rutas tipo POST
         */
        private array $rutas = array();

        /**
         * Funcion que inserta una ruta de tipo GET en el array de rutas
         * 
         * Parametros
         * string $ruta             ----> /login
         * array $accion            ----> [AuthController::class, 'login']
         */
        public function get(string $ruta, array $accion) : Router{
            $this->rutas['GET'][$ruta] = $accion;
            return $this;
        }

        /**
         * Funcion que inserta una ruta de tipo POST en el array de rutas
         * 
         * Parametros
         * string $ruta             ----> /login
         * array $accion            ----> [AuthController::class, 'doLogin']
         */
        public function post(string $ruta, array $accion) : Router{
            $this->rutas['POST'][$ruta] = $accion;
            return $this;
        }


        /**
         * Funcion que resuelva o lance el metodo o funcion del controlador asociado
         * 
         * Parametros
         * string URL               --> recibe la url para analizarla
         * string METHOD            --> recibe el tipo de ruta (GET, POST, etc)
         * 
         * La URL la recibo con mucho contenido. El objetivo es seccionar las partes para quedarme con la ultima seccion
         * Esto quiere decir que es necesario buscar una forma optima de conseguir ese ultimo trozo.
         * En el caso de /login, tenemos que la URL es .../index.php/login
         * Debemos decidir como seccionamos el STRING. 
         * 
         */
        public function resolver_ruta(string $url, string $method){
            # Almaceno el path de la url
            $path = parse_url($url)['path'];
            // var_dump(parse_url($url));

            $query = null;

            # Comprobar si existen variables en la url
            if(isset(parse_url($url)['query'])){
                # Obtiene la cadena de la consulta de la URL
                $query = parse_url($url, PHP_URL_QUERY);

                # Convertir la cadena de consulta (todas las variables) en un array clave-valor
                parse_str($query, $query);
            }
            // var_dump($query);
            // exit();
            # Seccionar el $path en varios strings
            $path2 = explode("/", $path);

            # En mi caso, el correcto seria $path2[6]
            # Debemos coger el ULTIMO elemento 
            // var_dump($path2);

            $ruta = '/'.$path2[count($path2) -1];
            // var_dump($ruta);

            # Recoger el nombre de la clase que necesito
            $clase = $this->rutas[$method][$ruta][0];
            # Recoger el nombre de la funcion que necesito
            $function = $this->rutas[$method][$ruta][1];
            //  var_dump('La clase que se va a ejecutar es: '. $clase);
            //var_dump('La function que se va a ejecutar es: '. $function);
            //var_dump($this->rutas);
            //exit();
            return call_user_func($clase.'::'.$function, $query);
        }
     }
?>