<?php

namespace Artdarek\Pusherer;

use \Config;
use \Pusher;

class Pusherer
{
    protected $connection = NULL;

    protected $instance   = NULL;

    public function __construct() {}

    public function on($connection, $ignoreClassInstance = false)
    {
        if ($ignoreClassInstance === false && $connection === $this->connection) {
            return $instance;
        }

        $connections = Config::get('pusherer::connections');
        if (! isset($connections[$connection])) {
            throw new PushererException(
                "Pusherer has failed to instantiate because \"{$connection}\" configuration does not exist."
            );
        }

        $this->instance = new Pusher(
            $connections[$connection]['key'],
            $connections[$connection]['secret'],
            $connections[$connection]['app_id'],
            $connections[$connection]['debug'],
            $connections[$connection]['host'],
            $connections[$connection]['port'],
            $connections[$connection]['timeout']
        );

        return $this->instance;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([__NAMESPACE__ . "\Pusherer", $name], $arguments);
        }

        $instance = $this->on(Config::get('pusherer::default'), true);
        return call_user_func_array([$instance, $name], $arguments);
    }
}