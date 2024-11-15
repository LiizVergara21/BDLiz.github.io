<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_LIBRO.php";

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");

    $modelo = selectFirst(pdo: Bd::pdo(), from: LIBRO, where: [LIBRO_ID => $id]);

    if ($modelo === false) {
        $idHtml = htmlentities($id);
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Libro no encontrado.",
            type: "/error/libronoencontrado.html",
            detail: "No se encontró ningún Libro con el id $idHtml."
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $modelo[LIBRO_NOMBRE]],
        "autor" => ["value" => $modelo[LIBRO_AUTOR]],
        "genero" => ["value" => $modelo[LIBRO_GENERO]],
    ]);
});