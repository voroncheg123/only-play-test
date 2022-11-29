<?php

class Logger {

    public static function log(string $logStorage, array $content): void
    {
        if(!file_exists($logStorage)){
            mkdir($logStorage);
        }

        foreach ($content as $pairName => $responses){
            $pairLogName = $pairName.'.log';
            foreach ($responses as $endPoint => $resp){
                $respParams = json_decode($resp, true);
                $logParams['request_type'] = $endPoint;
                if($respParams['success'] === true){
                    $logParams['success'] = $respParams['success'];
                    $logParams['error_message'] = '';
                }else{
                    $logParams['success'] = false;
                }

                if(!empty($respParams['code'])){
                    $logParams['error_message'] = $respParams['code'];
                }elseif (!empty($respParams['message']) && $respParams['success'] === false){
                    $logParams['error_message'] = $respParams['message'];
                }elseif (empty($resp)){
                    $logParams['error_message'] = 'Empty response';
                }

                if(!empty($respParams['action_id'])){
                    $logParams['action_id'] = $respParams['action_id'];
                }

                $toLog = json_encode($logParams);
                if(file_put_contents($logStorage.$pairLogName, $toLog.PHP_EOL, FILE_APPEND)){
                    echo 'Log writed'.PHP_EOL;
                }
            }
        }
    }

}
