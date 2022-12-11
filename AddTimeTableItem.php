<?php

require_once __DIR__ . '/Tool.php';

class AddTimeTableItem extends Tool {

    function process($data) {
        $params = [ $data['from'], $data['to'], $data['state'] ];
        $this->db->create_update_delete('INSERT INTO `time_table`(`from_time`, `to_time`, `state`) VALUES (?, ?, ?);', $params);
        return [];
    }

}

(new AddTimeTableItem())->exc();