<?php

require_once __DIR__ . '/Tool.php';

class GetSettings extends Tool {

    function process($data) {
        return $this->db->read('SELECT * FROM `settings`');
    }

}

(new GetSettings())->exc();