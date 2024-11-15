<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {
    // Obtener la lista de libros ordenados por nombre
    $lista = select(pdo: Bd::pdo(), from: LIBRO, orderBy: LIBRO_NOMBRE);
    
    // Inicia la lista de descripción con clases de Bootstrap
    $render = "<dl class='row'>";
    
    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[LIBRO_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[LIBRO_NOMBRE]);
        $autor = htmlentities($modelo[LIBRO_AUTOR]);
        $genero = htmlentities($modelo[LIBRO_GENERO]);
        
        // Agregar cada libro a la lista con su respectivo enlace
        $render .= "
            <div class='col-12'>
               <dt>
               <a href='modifica.html?id=$id'>$nombre</a>
               </dt>
               <dd><a href='modifica.html?id=$id'>$autor, $genero</a></dd>
            </div>
            <button> </button>
        ";
    }

    $render .= "</dl>"; // Cerrar el <dl> de la lista

    // Devolver la lista renderizada como JSON
    devuelveJson(["tabla" => ["innerHTML" => $render]]);
});
