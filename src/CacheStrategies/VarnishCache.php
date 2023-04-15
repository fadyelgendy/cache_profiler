<?php

namespace Fadyandrawes\CacheProfiler;

use Fadyandrawes\CacheProfiler\CacheStrategies\CacheInterface;

class VarnishCache implements CacheInterface
{
    public function handle(): array
    {
        return [];
    }

    public function handleRequest(array $request): void
    {
        
    }

    public function data()
    {
        
    }
}