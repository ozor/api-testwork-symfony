<?php

declare(strict_types=1);

namespace App\Model;

class Grpc implements ModelInterface
{
    private string $field1;

    private bool $field2;

    private int $field3;

    public function getField1(): string
    {
        return $this->field1;
    }

    public function setField1(string $field1): void
    {
        $this->field1 = $field1;
    }

    public function isField2(): bool
    {
        return $this->field2;
    }

    public function setField2(bool $field2): void
    {
        $this->field2 = $field2;
    }

    public function getField3(): int
    {
        return $this->field3;
    }

    public function setField3(int $field3): void
    {
        $this->field3 = $field3;
    }

    public function toArray(): array
    {
        return [
            'field1' => $this->getField1(),
            'field2' => $this->isField2(),
            'field3' => $this->getField3(),
        ];
    }
}
