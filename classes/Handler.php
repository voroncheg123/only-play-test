<?php
declare(strict_types=1);

class Handler
{
    private string $filesStorage;
    private string $logStorage;
    private array $paramsGeneratorsNames;

    public function __construct(string $filesStorage, string $logStorage, array $paramsGeneratorsNames)
    {
        $this->filesStorage = $filesStorage;
        $this->logStorage = $logStorage;
        $this->paramsGeneratorsNames = $paramsGeneratorsNames;
        $this->launchRequests();
    }

    private function launchRequests(): void
    {
        $pairsArray = ElemsGenerator::generatePairArray($this->filesStorage);
        $paramsGeneratorsObjects = ElemsGenerator::generateParamsGeneratorsObjectsArray($this->paramsGeneratorsNames);

        foreach ($pairsArray as $pair){
            $logs = [];
            $logsPairName = $pair["start_round_param"]['file'].'-'.$pair["end_round_param"]['file'];
            foreach ($pair as $pairElem){
                $path_parts = pathinfo($pairElem['file']);
                $params = ElemsGenerator::generateRequestParams($this->filesStorage.$pairElem['file'], $paramsGeneratorsObjects[$path_parts['extension']]);
                $url = API_BASE_URL.$pairElem['end_point'];
                $response = Requester::postRequest($url, $params, 'Content-Type: application/json');
                $logs[$logsPairName][$pairElem['end_point']] = $response;
            }
            Logger::log($this->logStorage, $logs);
        }
    }

}