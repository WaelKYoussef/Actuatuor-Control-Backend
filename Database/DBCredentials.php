<?php
/**
 * Created by PhpStorm.
 * User: waelyoussef
 * Date: 2020-04-15
 * Time: 10:34
 */

class DBCredentials
{
    public $server;
    public $db_name;
    public $username;
    public $password;
    public $uses_socket;
    public $socket;

    public function __construct($server, $db_name, $username, $password, $uses_socket = false, $socket = '')
    {
        $this->server = $server;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->uses_socket = $uses_socket;
        $this->socket = $socket;
    }
}