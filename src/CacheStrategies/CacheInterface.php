<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

interface CacheInterface
{
    public function handle();
    
    public function data();
}
