<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

use Fadyandrawes\CacheProfiler\CacheStrategies\CacheInterface;
use Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum;
use Fadyandrawes\CacheProfiler\View;
use Throwable;

class RedisCache extends View implements CacheInterface
{
    protected $redis;

    public function __construct(
        protected string $host,
        protected int|string $port,
        protected float $time_out = 2.5,
        protected string $reserved = '',
        protected int $retry_interval = 100,
        protected float $read_timeout = 0,
        protected array $options = []
    ) {
    }

    public function handle()
    {
        try {
            $this->redis = new \Redis();
    
            $this->redis->connect(
                $this->host,
                $this->port,
                $this->time_out,
                $this->reserved,
                $this->retry_interval,
                $this->read_timeout,
                $this->options
            );
        } catch (Throwable $ex) {
            return "ERROR: " . $ex->getMessage() . ". Check your Redis server status!";
        }

        if ($this->redis) {
            return $this->render(['title' => CacheDriverEnum::REDIS->value, 'info' => $this->redis->info()]);
        } else {
            return "ERROR: Connection Failed!";
        }
    }
}
