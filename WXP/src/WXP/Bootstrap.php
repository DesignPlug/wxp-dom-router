<?php namespace WXP;

use WXP\Autoloader;
use WXP\WXP;
use WXP\View;
use WXP\DomRouter;

class Bootstrap {
    
    /*************************************************
     * Register theme dir so that autoloader
     * will check the current theme directory for
     * controllers etc... 
     *************************************************/
    
    
    static function theme($path_to_classes = "", $config_path = ""){
        
        $path     = $c_path = WXP::DS(get_template_directory());
        $path    .= $path_to_classes ? WXP::DS('\\' .$path_to_classes) : "";
        $c_path  .= $config_path ? WXP::DS('\\' .$config_path) : "";
        
        
        spl_autoload_register(array(new Autoloader($path), "load"));
        
        static::register_paths($c_path); 
    }
    
    static function register_paths($path){
        
        /******************************************
         * Require init & constants files if exists
         ******************************************/
        
        add_action('after_setup_theme', function() use($path){

            if(file_exists(WXP::DS($path ."\config\constants.php"))){
                require WXP::DS($path ."\config\constants.php");
            }
            
            if(file_exists(WXP::DS($path ."\config\init.php"))){
                require WXP::DS($path ."\config\init.php");
            }
            
            //load scripts if exist

            if(file_exists(WXP::DS($path ."\config\scripts.php"))){
                require WXP::DS($path ."\config\scripts.php");
            }
            
            //load dom routes if exist
            
            if(file_exists(WXP::DS($path ."\config\dom-routes.php"))){
                require WXP::DS($path ."\config\dom-routes.php");
            }
        });
    }
    
    
    /*************************************************
     * Init requires all config/init files registers
     * dom-routes and scripts
     *************************************************/
    
    static function init(){
        
        /*********************************************
         * DOM ROUTING
         * - router calls methods based on body class
         *********************************************/

        add_filter('template_include', function($default_template){

            //add default values to view
            View::getInstance()->add("base_template", WXP::DS($default_template));
            
            DomRouter::getInstance()->route();

            //if dom routes define a base template use it, 
            //otherwise use default wp template

            return view_var("base_template");
        });
        
    }
    
}

?>
