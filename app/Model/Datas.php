<?php

class Datas {

    private $begin;
    private $end;

    public function set_begin($begin) {
        $this->begin = $begin;
    }

    public function get_begin() {
        return $this->begin;
    }

    public function set_end($end) {
        $this->end = $end;
    }

    public function get_end() {
        return $this->end;
    }
}