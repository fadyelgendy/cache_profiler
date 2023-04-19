<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

use Throwable;
use Fadyandrawes\CacheProfiler\View;
use Fadyandrawes\CacheProfiler\Enums\ResponseEnum;
use Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum;

class MemcachedCache extends View implements CacheInterface
{
    protected $memcached;

    public function __construct(
        protected string $host,
        protected int|string $port
    ) {
    }

    public function handle(): array
    {
        try {
            $this->memcached = new \Memcached();
            $this->memcached->addServer($this->host, $this->port);

            return [
                'status' => ResponseEnum::SUCESS,
                'message' => "Connetced!"
            ];
        } catch (Throwable $exc) {
            return [
                'status' => ResponseEnum::FAILED,
                'message' => "ERROR: " . $exc->getMessage()
            ];
        }
    }

    public function handleRequest(array $request): void
    {
    }

    public function data($extra = null)
    {
        $data = $this->memcached->getStats();

        return $this->render([
            'title' => CacheDriverEnum::MEMCACHED->value,
            'data' => $data,
            'keys' => [],
            'extra' => $extra
        ]);
    }
}
