<?php

require_once __DIR__ . '/Tool.php';

class DeleteTimeTableItem extends Tool {

    function process($data) {
        $params = [ $data['id'] ];
        $this->db->create_update_delete('DELETE FROM `time_table` WHERE `id` = ? LIMIT 1;', $params);
        return [];
    }

}

(new DeleteTimeTableItem())->exc();