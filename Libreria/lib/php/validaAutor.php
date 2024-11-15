<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaAutor(false|string $autor)
{
    if ($autor === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el Autor.",
            type: "/error/faltaautor.html",
            detail: "La solicitud no tiene el valor de Autor."
        );
    }

    $trimAutor = trim($autor);

    if ($trimAutor === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Autor en blanco.",
            type: "/error/autorblanco.html",
            detail: "Pon texto en el campo Autor."
        );
    }

    if (strlen($trimAutor) < 3) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Autor demasiado corto.",
            type: "/error/autorcorpo.html",
            detail: "El Autor debe tener mínimo 3 caracteres."
        );
    }

    return $trimAutor;
}
