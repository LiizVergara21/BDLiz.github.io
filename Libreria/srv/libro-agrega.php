<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaAutor.php";
require_once __DIR__ . "/../lib/php/validaGenero.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

    $nombre = recuperaTexto("nombre");
    $autor = recuperaTexto("autor");
    $genero = recuperaTexto("genero");

    $nombre = validaNombre($nombre);
    $autor = validaAutor($autor);
    $genero = validaGenero($genero);

    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: LIBRO, values: [
        LIBRO_NOMBRE => $nombre,
        LIBRO_AUTOR => $autor,
        LIBRO_GENERO => $genero
    ]);
    $id = $pdo->lastInsertId();

    $encodeId = urlencode($id);
    devuelveCreated("/srv/libro.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "autor" => ["value" => $autor],
        "genero" => ["value" => $genero],
    ]);
});
