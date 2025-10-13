<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Lista de excepciones que no se reportan.
     */
    protected $dontReport = [
        //
    ];

    /**
     * Reporta o logea una excepción.
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Renderiza una excepción en una respuesta HTTP.
     */
    public function render($request, Throwable $exception)
    {
        // Esto asegura que no falle por httpStatusCode
        return parent::render($request, $exception);
    }
}
