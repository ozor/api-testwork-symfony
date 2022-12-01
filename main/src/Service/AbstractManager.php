<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\ModelInterface;

abstract class AbstractManager
{
    protected ModelInterface $model;

    protected AbstractClient $client;

    public function setModel(ModelInterface $model): void
    {
        $this->model = $model;
    }

    public function setClient(AbstractClient $client): void
    {
        $this->client = $client;
    }

    public function update(string $url): array
    {
        $this->client->setUrl($url);
        $this->client->setMethodForUpdate();
        $this->client->setData($this->model->toArray());

        return $this->client->call();
    }

    public function get(string $url): ModelInterface
    {
        $this->client->setUrl($url);
        $this->client->setMethodForGet();

        return $this->arrayToModel($this->client->call());
    }

    abstract public function arrayToModel(array $data): ModelInterface;
}
