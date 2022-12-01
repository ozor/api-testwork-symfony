<?php

declare(strict_types=1);

namespace App\Service\Http;

use App\Service\AbstractClient;
use Exception;

class Client extends AbstractClient
{
    /**
     * Предполагаю, что отличие простого HTTP API от REST API (который тоже пользуется протоколом HTTP) в том,
     * что простой HTTP API использует методы, доступные через браузерный клиент. Следовательно, это GET и POST.
     * В данном клиенте я использую следующе методы:
     * GET - для получения данных
     * POST - для обновления данных
     * Другие операции согласно ТЗ не предусмотрены.
     *
     * @var array
     */
    protected static array $availableMethods = [
        self::METHOD_GET,
        self::METHOD_POST,
    ];

    public function setMethodForGet(): self
    {
        $this->setMethod(self::METHOD_GET);
        return $this;
    }

    public function setMethodForUpdate(): self
    {
        $this->setMethod(self::METHOD_POST);
        return $this;
    }

    public function call(): array
    {
        $this->validateEmptyProperties();

        $url    = $this->getUrl();
        $method = $this->getMethod();
        $data   = $this->getData();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (count($data) && $method === self::METHOD_POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);

        if ($info['http_code'] !== 200) {
            throw new Exception("Request data error");
        }

        return json_decode($response, true);
    }
}
