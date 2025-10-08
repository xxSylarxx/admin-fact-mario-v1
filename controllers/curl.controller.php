<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

class CurlController
{

    /*=============================================
    Ruta API
    =============================================*/
    public static function api()
    {

        // return "http://api.sistema.local/"; // Solo para desarrollo local
        return "http://3.20.235.212/api_sis_venta_sunat/"; // Para servidor
    }

    /*=============================================
    Peticiones a la API SUNAT
    =============================================*/
    public static function requestSunat($url, $method, $fields, $token)
    {

        $curl = curl_init();

        if ($token != '') {

            $header = array(
                'Authorization: Bearer ' . $token,
            );

        } else {

            $header = array();

        }

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'http://api.sistema.local/' . $url, // Solo para desarrollo local
            CURLOPT_URL => 'http://3.20.235.212/api_sis_venta_sunat/' . $url, // Para servidor
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);
        return $response;

    }

}