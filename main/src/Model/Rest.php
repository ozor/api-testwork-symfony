<?php

declare(strict_types=1);

namespace App\Model;

class Rest implements ModelInterface
{
    private string $field1;

    private bool $field2;

    /** @var string[] $field3 */
    private array $field3;

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
            'field1' => $this->getField1(),
            'field2' => $this->isField2(),
            'field3' => $this->getField3(),
        ];
    }
}
