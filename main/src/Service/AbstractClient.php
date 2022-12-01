<?php

declare(strict_types=1);

namespace App\Service;

use Exception;

abstract class AbstractClient
{
    public const METHOD_GET    = 'GET';
    public const METHOD_POST   = 'POST';
    public const METHOD_PUT    = 'PUT';
    public const METHOD_PATCH  = 'PATCH';
    public const METHOD_DELETE = 'DELETE';

    protected static array $availableMethods = [
        self::METHOD_GET,
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_PATCH,
        self::METHOD_DELETE,
    ];

    protected string $url;

    protected string $method;

    protected array $data = [];

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $method = strtoupper($method);
        $this->validateMethod($method);

        $this->method = $method;
        return $this;
    }

    public function get(): array
    {
        $this->setMethodForGet();

        return $this->call();
    }

    public function update(array $data): array
    {
        $this->setMethodForUpdate();
        $this->setData($data);

        return $this->call();
    }

    /**
     * @throws Exception
     */
    protected function validateMethod(string $method): void
    {
        if (!in_array($method, static::$availableMethods)) {
            throw new Exception('Unavailable request method');
        }
    }

    /**
     * @throws Exception
     */
    protected function validateEmptyProperties(): void
    {
        if (empty($this->url)) {
            throw new Exception('Empty request URL');
        }
        if (empty($this->method)) {
            throw new Exception('Empty request method');
        }
    }

    abstract public function setMethodForGet(): self;
    abstract public function setMethodForUpdate(): self;

    abstract public function call(): array;
}
