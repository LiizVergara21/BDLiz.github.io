<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaNombre(false|string $nombre)
{
    if ($nombre === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el Nombre.",
            type: "/error/faltanombre.html",
            detail: "La solicitud no tiene el valor de Nombre."
        );
    }

    $trimNombre = trim($nombre);

    if ($trimNombre === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Nombre en blanco.",
            type: "/error/nombreblanco.html",
            detail: "Pon texto en el campo Nombre."
        );
    }

    // Validación de longitud mínima
    if (strlen($trimNombre) <= 2) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Nombre demasiado corto.",
            type: "/error/nombrecorto.html",
            detail: "El Nombre debe tener mínimo 3 caracteres."
        );
    }

    return $trimNombre;
}
