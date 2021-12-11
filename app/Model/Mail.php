<?php

class Mail {

    private $to;
    private $to2;
    private $to3;
    private $to4;
    private $to5;
    private $to6;
    private $to7;
    private $to8;
    private $to9;
    private $to10;
    private $to11;
    private $subject;
    private $body;
    private $anexo;
    
    public function set_to2($to2) {
        $this->to2 = $to2;
    }

    public function get_to2() {
        return $this->to2;
    }
    
    public function set_to3($to3) {
        $this->to3 = $to3;
    }

    public function get_to3() {
        return $this->to3;
    }
    
    public function set_to4($to4) {
        $this->to4 = $to4;
    }

    public function get_to4() {
        return $this->to4;
    }
    
    public function set_to5($to5) {
        $this->to5 = $to5;
    }

    public function get_to5() {
        return $this->to5;
    }
    
    public function set_to6($to6) {
        $this->to6 = $to6;
    }

    public function get_to6() {
        return $this->to6;
    }
    
    public function set_to7($to7) {
        $this->to7 = $to7;
    }

    public function get_to7() {
        return $this->to7;
    }
    
    public function set_to8($to8) {
        $this->to8 = $to8;
    }

    public function get_to8() {
        return $this->to8;
    }
    
    public function set_to9($to9) {
        $this->to9 = $to9;
    }

    public function get_to9() {
        return $this->to9;
    }
    
    public function set_to10($to10) {
        $this->to10 = $to10;
    }

    public function get_to10() {
        return $this->to10;
    }
    
    public function set_to11($to11) {
        $this->to11 = $to11;
    }

    public function get_to11() {
        return $this->to11;
    }

    public function set_to($to) {
        $this->to = $to;
    }

    public function get_to() {
        return $this->to;
    }
    
    public function set_anexo($anexo) {
        $this->anexo = $anexo;
    }

    public function get_anexo() {
        return $this->anexo;
    }

    public function set_subject($subject) {
        $this->subject = $subject;
    }

    public function get_subject() {
        return $this->subject;
    }

    public function set_body($body) {
        $this->body = $body;
    }

    public function get_body() {
        return $this->body;
    }
}
