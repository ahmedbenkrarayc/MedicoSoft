<?php

namespace Core;

class View{

    public function __construct(
        private $view,
        private $params
    ){

    }

    public static function make($view, $params = []){
        return new static($view, $params);
    }

    public function render(){
        ob_start();
        include __DIR__.'/../app/views/'.$this->view.'.php'; 
        return ob_get_clean();
    }

    public function __toString(){
        return $this->render();
    }
}