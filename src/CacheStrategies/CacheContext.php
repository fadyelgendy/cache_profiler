<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

class CacheContext
{
    private CacheInterface $cache;

    public function setStrategy(CacheInterface $cacheInterface): self
    {
        $this->cache = $cacheInterface;

        return $this;
    }

    // TODO: Add connection options
    public function executeStrategy()
    {
        return $this->cache->handle();
    }
}
