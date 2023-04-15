<?php

namespace Fadyandrawes\CacheProfiler\CacheStrategies;

use Fadyandrawes\CacheProfiler\CacheStrategies\CacheInterface;
use Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum;
use Fadyandrawes\CacheProfiler\Enums\DatatypeEnum;
use Fadyandrawes\CacheProfiler\Enums\OSEnum;
use Fadyandrawes\CacheProfiler\Enums\ResponseEnum;
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

    public function handle(): array
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

            return [
                'status' => ResponseEnum::SUCESS,
                'message' => "Connetced!"
            ];
        } catch (Throwable $ex) {
            return [
                'status' => ResponseEnum::FAILED,
                'message' => "ERROR: " . $ex->getMessage()
            ];
        }
    }

    public function handleRequest(array $request): void
    {
        if (array_key_exists('form_type', $request)) {
            if ($request['form_type'] === 'store') {
                $result = $this->handleStore($request);
            }

            if ($request['form_type'] === 'destroy') {
                $result = $this->handleDestroy($request);
            }

            if ($request['form_type'] === 'flush_current' || $request['form_type'] === 'flush_all') {
                $result = $this->handleFlush($request);
            }

            if ($request['form_type'] === 'close_connection') {
                $result = $this->HandleServerActions($request);
            }
        }

        // Flash to sesion
        $_SESSION[$result['status']] = $result['message'];

        $driver = explode('=', $_SERVER['QUERY_STRING'])[1];

        header("Location: handler.php?driver=". $driver);
        exit;
    }

    public function data($extra = null)
    {
        $info = $this->redis->info();

        $os = OSEnum::LINUX->value;

        if (str_starts_with($info['os'], 'WIN')) {
            $os = OSEnum::WINDOWS;
        }

        if (str_starts_with($info['os'], 'darwin')) {
            $os = OSEnum::OSX;
        }

        $data['server']['version'] = $info['redis_version'];
        $data['server']['mode'] = $info['redis_mode'];
        $data['server']['os'] = $os;
        $data['server']['port'] = $info['tcp_port'];
        $data['server']['uptime'] = formatTime($info['uptime_in_seconds']);
        $data['server']['uptime_days'] = $info['uptime_in_days'];
        $data['server']['clusters_enabled'] = $info['cluster_enabled'];
        $data['server']['architecture'] = $info['arch_bits'];
        $data['server']['gcc_version'] = $info['gcc_version'];
        $data['server']['role'] = $info['role'];
        $data['server']['slaves'] = $info['connected_slaves'];

        $data['memory']['used'] = $info['used_memory_human'];
        $data['memory']['rss'] = $info['used_memory_rss_human'];
        $data['memory']['peak'] = $info['used_memory_peak_human'];
        $data['memory']['overhead'] = $info['used_memory_overhead'];
        $data['memory']['startup'] = $info['used_memory_startup'];
        $data['memory']['system'] = $info['total_system_memory_human'];
        $data['memory']['lua'] = $info['used_memory_lua_human'];
        $data['memory']['scripts'] = $info['used_memory_scripts_human'];
        $data['memory']['max'] = $info['maxmemory_human'];
        $data['memory']['policy'] = $info['maxmemory_policy'];

        $data['cpu']['sys'] = $info['used_cpu_sys'];
        $data['cpu']['sys_children'] = $info['used_cpu_sys_children'];
        $data['cpu']['user'] = $info['used_cpu_user'];
        $data['cpu']['user_children'] = $info['used_cpu_user_children'];

        $data['databases'][] = $info['db0'];

        $data['configuration']['bin'] = $info['executable'];
        $data['configuration']['config'] = $info['config_file'];

        return $this->render([
            'title' => CacheDriverEnum::REDIS->value,
            'data' => $data,
            'keys' => $this->getStoredData(),
            'extra' => $extra
        ]);
    }

    protected function getStoredData(): array
    {
        $stored = [];

        foreach ($this->redis->keys('*') as $key) {
            $res = $this->redis->get($key);

            if (!is_string($res)) {
                $res = $this->redis->hGetAll($key);
            }

            $stored[$key] = $res;
        }
        
        return $stored;
    }

    protected function handleStore(array $request): array
    {
        if (array_key_exists('data_type', $request)) {
            $value = trim($request['value']);

            // String
            if ($request['data_type'] == DatatypeEnum::STRING->value) {
                $expiry = trim($request['expiration']);
                $s_key = trim($request['string_key']);
                $this->redis->set($s_key, $value, $expiry);
            } else if ($request['data_type'] == DatatypeEnum::HASH->value) {
                $hash = trim($request['hash']);
                $h_key = trim($request['hash_key']);

                if (!$this->redis->hExists($hash, $h_key)) {
                    $this->redis->hSet($hash, $h_key, $value);
                } else {
                    return [
                        'status' => 'failed',
                        'message' => 'Key Already Exists!'
                    ];
                }
            } else {
                return [
                    'status' => 'failed',
                    'message' => 'Data type not supported!'
                ];
            }

            return [
                'status' => 'success',
                'message' => 'Saved Successfully!'
            ];
        }

        return [
            'status' => 'failed',
            'message' => 'No Data type procided!'
        ];
    }

    protected function handleDestroy(array $request): array
    {
        if (array_key_exists('keys', $request)) {
            if ($this->redis->exists(...$request['keys'])) {
                $this->redis->del(...$request['keys']);

                return [
                    'status' => 'success',
                    'message' => 'Deleted Successfully!'
                ];
            } else {
                return [
                    'status' => 'failed',
                    'message' => 'Target key doesn\'t exists!'
                ];
            }
        }

        return [
            'status' => 'failed',
            'message' => 'No data sent in the request!'
        ];
    }

    protected function handleFlush(array $request): array
    {
        if (array_key_exists('form_type', $request)) {
            if ($request['form_type'] === 'flush_current') {
                $this->redis->flushDb();
            }

            if ($request['form_type'] === 'flush_all') {
                $this->redis->flushAll();
            }

            return [
                'status' => 'success',
                'message' => 'Database Flushed!'
            ];
        } else {
            return [
                'status'=> 'failed',
                'message' => 'Flush Type Required!'
            ];
        }
    }

    public function HandleServerActions(array $request): array
    {
        if (array_key_exists('form_type', $request)) {
            if ($request['form_type'] === 'close_connection') {
                $this->redis->close();
            }

            return [
                'status' => 'success',
                'message' => 'Connection Closed!'
            ];
        } else {
            return [
                'status'=> 'failed',
                'message' => 'Missing Action Type!'
            ];
        }
    }
}
