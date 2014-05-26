<?php namespace WXP;

use \WXP\View;

class Controller {
    
    function __construct(){
        $this->View = View::getInstance();
    }
    
}

?>
