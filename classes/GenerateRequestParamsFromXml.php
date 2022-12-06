<?php

require_once PROJECT_ROOT.'/interfaces/GenerateRequestParamsInterface.php';

class GenerateRequestParamsFromXml implements GenerateRequestParamsInterface
{
    public function generateRequestParams(string $filePath): string
    {
        $xmlString = file_get_contents($filePath);
        $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $fileParams = json_decode($json,true);

        $requestParams['round_id'] = $fileParams["round-id"];

        if(array_key_exists('player-id',$fileParams)){
            $requestParams['player_id'] = $fileParams['player-id'];
        }elseif (array_key_exists('reward',$fileParams)){
            $requestParams['reward'] = $fileParams['reward'];
        }

        $requestParams['provider_id'] = PROVIDER_ID;
        $paramsToSign = json_encode($requestParams);
        $signingKey = ElemsGenerator::generateSign($paramsToSign);
        $requestParams['sign'] = $signingKey;

        $requestBody = json_encode($requestParams);
        return $requestBody;
    }
}