<?php
declare(strict_types=1);

require_once PROJECT_ROOT.'/interfaces/GenerateRequestParamsInterface.php';

class GenerateRequestParamsFromJson implements GenerateRequestParamsInterface
{
    public function generateRequestParams(string $filePath): string
    {
        $content = file_get_contents($filePath);
        $fileParams = json_decode($content,true);

        $requestParams['round_id'] = $fileParams["roundId"];

        if(array_key_exists('playerId',$fileParams)){
            $requestParams['player_id'] = $fileParams['playerId'];
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