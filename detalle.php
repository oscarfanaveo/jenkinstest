<?php

use PHPUnit\Framework\TestCase;

class DetalleTempsTest extends TestCase
{
    public function testDetalleTemp()
    {
        $url = "https://localhost:8080/Sistema-de-venta-v1-main/src/ajax.php";
        #campos que se enviaran al servicio de php
        $fields = array(
            'id' => 5,
            'cant' => 1,
            'precio' => 5699.77,
            'idUser' => 3,
            'action' => "regDetalle",
        );

        #postvars son los parámetros pos
        $postvars = '';
        $sep = '';
        #en este for damos formato a las variables que se enviaran por post
        foreach ($fields as $key => $value) {
            $postvars .= $sep . urlencode($key) . '=' . urlencode($value);
            $sep = '&';
        }

        #se inicia el proceso de llamado al servicio de insertar o actualizar detalle_temp
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        #aserción
        $this->assertContains($result, ['"registrado"', '"actualizado"'], "El mensaje: $result no se encuentra dentro los mensajes esperados");
    }
}
