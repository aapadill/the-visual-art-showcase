<?php
namespace Modelos;

interface Persistente {
    function cerrarConexion();
    function empezarTransaccion();
    function terminarTransaccion($success);
    function correrQuery($sql, $parametros = []);
}