<?php

require_once __DIR__ . '/Tool.php';

class SetSetting extends Tool {

    function process($data) {
        $params = [ $data['value'], $data['name'] ];
        $this->db->create_update_delete('UPDATE `settings` SET `value` = ? WHERE `name` = ? LIMIT 1;', $params);
        return [];
    }

}

(new SetSetting())->exc();