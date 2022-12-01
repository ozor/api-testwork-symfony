<?php

declare(strict_types=1);

namespace App\Service\Rest;

use App\Model\ModelInterface;
use App\Model\Rest;
use App\Service\AbstractManager;

class Manager extends AbstractManager
{
    public function __construct(
        Client $client,
        Rest $model,
    ) {
        $this->setModel($model);
        $this->setClient($client);
    }

    public function arrayToModel(array $data): ModelInterface
    {
        $this->model->setField1($data['field1']);
        $this->model->setField2($data['field2']);
        $this->model->setField3($data['field3']);

        return $this->model;
    }
}
