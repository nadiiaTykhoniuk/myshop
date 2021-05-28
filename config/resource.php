<?php

/**
 * Common resource configuration file
 */

return array(

	// default database configuration
	'db' => array(

		'adapter' => 'pqsql',

		'host' => '127.0.0.1',
		'port' => 5432,
		'database' => 'myshop',
		'username' => 'my_user',
		'password' => 'secret',
		'stmt' => array( "SET SESSIOn sort_buffer_size=2097144; SET NAMES 'utf8'; SET SESSION sql_mode='ANSI'" ),
		'limit' => 2,
		'opt-persistent' => false,
	),
	// If using the order domain in an other database or database server
	// 'db-order' => array('adapter' => 'mysql', 'host' => 'localhost', ....)

	// default message queue configuration
	'fs' => array(

		// file system adapter
		'adapter' => 'Standard',

		// base directory for file system view
		'basedir' => '.',
	),

	// default message queue configuration
	'mq' => array(

		// message queue adapter
		'adapter' => 'Standard',

		// use database configuration from resource "db"
		'db' => 'db',
	),
);
