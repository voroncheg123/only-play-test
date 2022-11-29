<?php

class ElemsGenerator
{
    public static function generateSign(string $stringToGenerate): string
    {
        $signingKey = hash_hmac('sha256', $stringToGenerate, KEY);
        return $signingKey;
    }

    public static function generateRequestParams(string $filePath, GenerateRequestParamsInterface $generateRequestParams)
    {
        return $generateRequestParams->generateRequestParams($filePath);
    }

    public static function generateParamsGeneratorsObjectsArray(array $paramsGeneratorsNames): array
    {
        foreach ($paramsGeneratorsNames as $ext => $className){
            $paramsGeneratorsNames[$ext] = new $className;
        }
        return $paramsGeneratorsNames;
    }

    public static function generatePairArray(string $filesStorage): array
    {
        $files = scandir($filesStorage);
        $requestQueue = [];
        foreach ($files as $file){
            if(is_file($filesStorage.$file)){
                $pair_array = self::generatePair($file);
                if(!in_array($pair_array,$requestQueue)){
                    $requestQueue[] = $pair_array;
                }
            }
        }

        return $requestQueue;
    }

    public static function generatePair(string $file): array
    {
        $pair_postfix = str_replace(['start_round','end_round'],'',$file);
        $start_round_arr['end_point'] = 'start_round';
        $start_round_arr['file'] = 'start_round'.$pair_postfix;
        $end_round_arr['end_point'] = 'end_round';
        $end_round_arr['file'] = 'end_round'.$pair_postfix;
        $array['start_round_param'] = $start_round_arr;
        $array['end_round_param'] = $end_round_arr;
        return $array;
    }
}