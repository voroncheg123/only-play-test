<?php
declare(strict_types=1);

class Requester
{
    public static function postRequest(string $url, string $params, string $contentType) : string
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$params);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [$contentType]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);

        $resp = curl_exec($curl);

        curl_close($curl);
        return $resp;
    }
}