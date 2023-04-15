<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

interface CacheInterface
{
    public function handle(): array;

    public function handleRequest(array $request): void;
    
    public function data();
}
