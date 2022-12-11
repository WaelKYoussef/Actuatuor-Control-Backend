<?php

require_once __DIR__ . '/Database/DBManager.php';
require_once __DIR__ . '/Database/DBCredentials.php';

class Tool {

    protected $db;

    public function __construct()
    {
        $cred = new DBCredentials('localhost', 'control', 'root', '');
        $this->db = new DBManager($cred);
    }

    public function exc() {
        set_error_handler(function ($severity, $message, $file, $line) {
            if (!(error_reporting() & $severity)) { return; }
            throw new ErrorException($message, 0, $severity, $file, $line);
        });

        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
            header('Content-Type: application/json; charset=utf-8');
            $output = ['status'=> 'success', 'payload'=> $this->process($data)];
        } catch (Exception $e) {
            $output = ['status'=> 'error', 'reason'=> $e->getMessage()];
        }
        exit(json_encode($output));
    }

    protected function process($data) {
        return [];
    }

}