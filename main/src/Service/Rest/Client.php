<?php

declare(strict_types=1);

namespace App\Service\Rest;

use App\Service\AbstractClient;
use Exception;

class Client extends AbstractClient
{
    /**
     * Предполагаю, что отличие простого HTTP API от REST API (который тоже пользуется протоколом HTTP) в том,
     * что REST API использует полный набор методов команд (GET, POST, PUT, PATCH и DELETE).
     * В данном клиенте (исходя из ограничений ТЗ) все они не нужны, я использую лишь следующе методы:
     * GET - для получения данных
     * PUT - для обновления данных
     * Другие операции согласно ТЗ не предусмотрены.
     *
     * @var array
     */
    protected static array $availableMethods = [
        self::METHOD_GET,
        self::METHOD_PUT,
    ];

    public function setMethodForGet(): self
    {
        $this->setMethod(self::METHOD_GET);
        return $this;
    }

    public function setMethodForUpdate(): self
    {
        $this->setMethod(self::METHOD_PUT);
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
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (count($data) && $method === self::METHOD_PUT) {
            curl_setopt($ch, CURLOPT_PUT, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        }

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);

        if ($info['http_code'] !== 200) {
            throw new Exception("Request data error");
        }

        return json_decode($response, true);
    }
}
