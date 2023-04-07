<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com',
	'port' => '5432',
	'username' => 'dms_superuser',
	'password' => '&%$rUuD/&v4N#*N15st3lr00y_-[',
	'database' => 'db_dms',
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['dbware'] = array(
	'dsn'	=> '',
	'hostname' => 'agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com',
	'port' => '5432',
	'username' => 'dms_superuser',
	'password' => '&%$rUuD/&v4N#*N15st3lr00y_-[',
	'database' => 'dbware',
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['datalake'] = array(
	'dsn'	=> '',
	'hostname' => 'agvpgsql.cd0jfjeqc6yz.us-east-1.rds.amazonaws.com',
	'port' => '5432',
	'username' => 'dms_superuser',
	'password' => '&%$rUuD/&v4N#*N15st3lr00y_-[',
	'database' => 'dbdata_lake',
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
