<?php

namespace backend\modules\plot\services;

use yii\httpclient\Client;

class CadastralApiService
{
    public function getData(array $cadastralNumbers)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setHeaders(['content-type' => 'application/json', 'Accept' => 'application/json'])
            ->setUrl('https://api.pkk.bigland.ru/test/plots')
            ->setFormat(Client::FORMAT_JSON)
            ->setData(
                [
                    'collection' => [
                        'plots' => $cadastralNumbers
                    ]
                ]
            )
            ->send();
        if ($response->isOk) {
            return $response->data;
        } else {
            return [];
        }
    }
}
