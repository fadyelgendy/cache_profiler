<?php

namespace Fadyandrawes\CacheProfiler\Enums;

enum CacheDriverEnum:string {
    case REDIS = 'redis';
    case MEMCACHED = 'memcached';
    case VARNISH = 'varnish';
}