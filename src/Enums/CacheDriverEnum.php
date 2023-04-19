<?php

namespace Fadyandrawes\CacheProfiler\Enums;

enum CacheDriverEnum: string
{
    case REDIS = 'redis';
    case MEMCACHED = 'memcached';
    case VARNISH = 'varnish';

    public static function getHost($driver): string
    {
        $host = '127.0.0.1';
        
        if ($driver == self::MEMCACHED->value) {
            $host = 'localhost';
        }

        if ($driver == self::VARNISH->value) {
            $host = '';
        }
        
        return $host;
    }

    public static function getPort( $driver): string
    {
        $port = '';
        
        if ($driver == self::REDIS->value) {
            $port = '6379';
        }

        if ($driver == self::MEMCACHED->value) {
            $port = '11211';
        }
        
        return $port;
    }
}
