<?php

declare(strict_types=1);

namespace App\Model;

class Http implements ModelInterface
{
    private bool $field1;

    private int $field2;

    /** @var string[]|int[] $field3 */
    private array $field3;

    public function isField1(): bool
    {
        return $this->field1;
    }

    public function setField1(bool $field1): void
    {
        $this->field1 = $field1;
    }

    public function getField2(): int
    {
        return $this->field2;
    }

    public function setField2(int $field2): void
    {
        $this->field2 = $field2;
    }

    public function getField3(): array
    {
        return $this->field3;
    }

    public function setField3(array $field3): void
    {
        $this->field3 = $field3;
    }

    public function toArray(): array
    {
        return [
            'field1' => $this->isField1(),
            'field2' => $this->getField2(),
            'field3' => $this->getField3(),
        ];
    }
}
