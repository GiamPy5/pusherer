<?php

namespace Artdarek\Pusherer;

use \Config;
use \Pusher;

class Pusherer
{
    public function __construct() {}

    public function on($connection)
    {
        $connections = Config::get('pusherer::connections');
        if (! isset($connections[$connection])) {
            throw new PushererException(
                "Pusherer has failed to instantiate because \"{$connection}\" configuration does not exist."
            );
        }

        $pusher = new Pusher(
            $connections[$connection]['key'],
            $connections[$connection]['app_id'],
            $connections[$connection]['secret'],
            $connections[$connection]['debug'],
            $connections[$connection]['host'],
            $connections[$connection]['port'],
            $connections[$connection]['timeout']
        );

        // return pusher
        return $pusher;
    }
}