<?php

require_once __DIR__ . '/Tool.php';

class GetTimeTable extends Tool {

    function process($data) {
        return $this->db->read('SELECT * FROM `time_table`');
    }

}

(new GetTimeTable())->exc();