<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

interface CacheInterface
{
    public function handle(array $request);
    
    public function data();
}
