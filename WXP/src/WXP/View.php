<?php namespace WXP;


class View {
    
    protected $data = array();
    static protected $instance;
    
    static function __callStatic($name, $param)
    {
        if(method_exists(self, $name)){
            return call_user_func_array(array(self::getInstance(), $name), $param);
        }
    }
    
    static function getInstance(){
       
        if(!self::$instance){
            $class = __CLASS__;
            static::$instance = new $class;
        }
        return self::$instance;
    }
    
    function add($name, $value){
        $this->data[$name] = $value;
        return $this;
    }
    
    function get($name){
        return @$this->data[$name];
    }
    
    
    
    
    
}

?>
