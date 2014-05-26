<?php namespace WXP;

class WXP {
    
    public static function get_template_part($slug, $name = null, $relative = true){
        
        //use post type as format, if no format or name given 
        if(is_null($name)){
            $name = $name?: get_post_format()?: get_post_type();
        }
        //attempt to get template from relative path
        //if possible, instead of from template root directory
        
        $dbt                = debug_backtrace();
        $calling_file_dir   = self::DS(dirname($dbt[0]['file']));
        $template_dir       = self::DS(get_template_directory());
        
        //now strip the template root directory from the calling file dir
        
        if ($relative && substr($calling_file_dir, 0, strlen($template_dir)) === $template_dir) {
            $slug = self::DS(substr($calling_file_dir, strlen($template_dir)) ."/" .ltrim($slug, "/"));
        } 
        
        $values = apply_filters("WXP.get_template_part", array('slug' => $slug, 'name' => $name));
        
        get_template_part($values['slug'], $values['name']);
    }
    
    public static function DS($dir){
        return str_replace(array("/","\\"), DIRECTORY_SEPARATOR, $dir);
    }
    
}

?>
