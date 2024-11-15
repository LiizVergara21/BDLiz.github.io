<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaAutor.php";
require_once __DIR__ . "/../lib/php/validaGenero.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");
    $nombre = recuperaTexto("nombre");
    $autor = recuperaTexto("autor");
    $genero = recuperaTexto("genero");

    $nombre = validaNombre($nombre);
    $autor = validaAutor($autor);
    $genero = validaGenero($genero);

    update(
        pdo: Bd::pdo(),
        table: LIBRO,
        set: [
            LIBRO_NOMBRE => $nombre,
            LIBRO_AUTOR => $autor,
            LIBRO_GENERO => $genero
        ],
        where: [LIBRO_ID => $id]
    );

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "autor" => ["value" => $autor],
        "genero" => ["value" => $genero],
    ]);
});
