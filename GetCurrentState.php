<?php

require_once __DIR__ . '/Tool.php';

class GetCurrentState extends Tool {

    function process($data) {
        $map = [];
        $settings =  $this->db->read('SELECT * FROM `settings`');
        foreach ($settings as $setting)
            $map[$setting['name']] = $setting['value'];
        $operation = $map['operation'];

        $state =  ($operation == 'manual') ? $this->manual_state($map) : $this->time_based_state($map);

        return ['state'=> $state];
    }

    private function manual_state($settings) {
        $state = $settings['current_manual_state'];
        $possible_states = ['expand', 'contract', 'off'];
        return in_array($state, $possible_states) ? $state : 'off';
    }

    private function time_based_state($settings) {
        $time_zone = $settings['timezone'];
        date_default_timezone_set($time_zone);
        $time_items =  $this->db->read('SELECT * FROM `time_table`');
        foreach($time_items as $time_item)
            if ($this->current_time_matches($time_item))
                return $time_item['state'];
        return 'off';
    }

    private function current_time_matches($time_table_item) {
        $from = $time_table_item['from_time'];
        $to = $time_table_item['to_time'];
        $date = date('Y-m-d');
        $from_time_stamp = "{$date} $from";
        $to_time_stamp = "{$date} $to";
        $now = date('Y-m-d h:i');
        return ($now >= $from_time_stamp) && ($now <= $to_time_stamp);
    }

}

(new GetCurrentState())->exc();