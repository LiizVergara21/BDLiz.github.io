<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaGenero(false|string $genero)
{
    if ($genero === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el Género.",
            type: "/error/faltagenero.html",
            detail: "La solicitud no tiene el valor de Género."
        );
    }

    $trimGenero = trim($genero);

    if ($trimGenero === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Género en blanco.",
            type: "/error/generoblanco.html",
            detail: "Pon texto en el campo Género."
        );
    }

    if (strlen($trimGenero) < 3) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Género demasiado corto.",
            type: "/error/generocorto.html",
            detail: "El Género debe tener mínimo 3 caracteres."
        );
    }

    return $trimGenero;
}
