<?php

require_once __DIR__ . '/Tool.php';

class SetTimeTable extends Tool {

    function process($data) {
        $items = $data['items'];

        $this->db->create_update_delete('TRUNCATE `time_table`');

        $mapped = array_map(function ($item) {
            return '(\'' . $item['from'] . '\',\'' . $item['to'] . '\',\'' . $item['state'] . '\')';
            }, $items);

        $args = implode(', ', $mapped);
        $query = "INSERT INTO `time_table`(`from_time`, `to_time`, `state`) VALUES $args;";
        $this->db->create_update_delete($query);
        return [];
    }
}

(new SetTimeTable())->exc();