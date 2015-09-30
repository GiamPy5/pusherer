<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Pusher Config
	|--------------------------------------------------------------------------
	|
	| Pusher is a simple hosted API for quickly, easily and securely adding
	| realtime bi-directional functionality via WebSockets to web and mobile
	| apps, or any other Internet connected device.
	|
	*/

	'default' => 'default',

	'connections' => [

		'default' => [

			'app_id'  => '',

			'key'     => '',

			'secret'  => '',

			'debug'   => false,

			'host'    => 'http://api.pusherapp.com',

			'port'    => 80,

			'timeout' => 30

		]

	]

];
