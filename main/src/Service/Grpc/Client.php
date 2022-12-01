<?php

declare(strict_types=1);

namespace App\Service\Grpc;

use App\Service\AbstractClient;

class Client extends AbstractClient
{
    public const METHOD_GRPC = 'GRPC';

    protected static array $availableMethods = [
        self::METHOD_GRPC,
    ];

    public function setMethodForGet(): self
    {
        $this->setMethod(self::METHOD_GRPC);
        return $this;
    }

    public function setMethodForUpdate(): self
    {
        echo self::METHOD_GRPC;
        $this->setMethod(self::METHOD_GRPC);
        return $this;
    }

    /**
     * Не имею опыта в реализации общения с gRPC API на стороне Symfony.
     * Для его реализации нужно установленное расширение protobuf, настройка *.proto файла и т.д.
     * На эти действия времени в рамках периода, выделенного на написание тестового задания, нет,
     * равно как на освоение других библиотек получения данных по gRPC (например, gRPCurl).
     *
     * @return array
     */
    public function call(): array
    {
        return [];
    }
}
