<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

use Fadyandrawes\CacheProfiler\Enums\ResponseEnum;

class CacheContext
{
    private CacheInterface $cache;

    public function setStrategy(CacheInterface $cacheInterface): self
    {
        $this->cache = $cacheInterface;

        return $this;
    }

    // TODO: Add connection options
    public function executeStrategy(array $request)
    {
        $response = $this->cache->handle();

        if ($response['status'] === ResponseEnum::SUCESS) {
            if (!empty($request) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->cache->handleRequest($request);

                return $this->cache->data();
            }
    
            return $this->cache->data();
        } else {
            return $response;
        }
    }
}
