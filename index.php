<?php
    $ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";  //Al parecer funciona como un condicional
    $array = explode("/", $ruta);  //devuelve un array a partir de un string
    $controller = $array[0];
    $metodo = "index";
    $parametro = "";

    if (!empty($array[1])) {  //Condicional denegacion de vacio se traduce como: Si exsiste A pasa B
        if (!empty($array[1] != "")) {
            $metodo = $array[1];
        }
    }

    if (!empty($array[2])) {
        if (!empty($array[2] != "")) {
            for ($i=2; $i < count($array); $i++) {
                $parametro .= $array[$i]. ",";
            }
            $parametro = trim($parametro, ",");  //trim se usa para eliminar elementos de un array 
        }
    }
    $dirControllers = "Controllers/".$controller.".php";
    if (file_exists($dirControllers)) {
        require_once $dirControllers;
        $controller = new $controller();
        if (method_exists($controller, $metodo)) {
            $controller->$metodo($parametro);
        }else{
            echo "No existe el método";
        }
    }else{
        echo "No existe el controlador";
    }

?>