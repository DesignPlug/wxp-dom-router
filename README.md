wxp-dom-router
==============

WXP DomRouter is an easy to learn Wordpress plugin that allows theme developers to create beautiful, scalable, and extendable themes, 
using an object oriented interface. PHP DomRouter was inspired by JS “Dom based routing 
(http://www.paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution) 
which fires certain Javascript functions based upon the id or class of the document body. 
WXP DomRouter takes advantage of the body’s classes in much the same way, allowing developers to add data to the view 
based upon classes found in the document’s body tag. 

Installation
____________

1) Upload and activate wxp-dom-router in your WP plugin directory 

2) Download the files here: https://github.com/DesignPlug/WXP and upload to your theme's root directory

3) insert this line of code to your functions.php file

```php

if(current_theme_supports("WXP.DomRouter")){
    \WXP\Bootstrap::theme("WXP", "WXP\Theme");
}

```

Usage
_____

Have a look at WXP/Theme/config/dom-routes.php and bind controller actions to the body class of choice. Example:

WXP/Theme/config/dom-routes.php

```php

<?php use WXP\DomRouter;

  DomRouter::getInstance()->on($body_class, "Theme\Controllers\ControllerName#action");
  
?>

```

When the body has specified $body_class ControllerName::action will be called, which will
load data and make it accessible the view.

WXP/Theme/Controllers/ControllerName.php

```php 
 
   namespace Theme\Controllers;
  
   class ControllerName extends WXP\Controller{

      ...

      //do your queries, call functions, and every other 
      //form of logic OUTSIDE of your wordpress template,
      //and pass the values back to the view

      function action(){
          $this->View->add("page_header", $value)
                     ->add("template_name", $value2)
                     ->add("some_data", $value3);
      }

      ...
   }

```

Now finally access your variables inside your wordpress template

```php

   <h1><?php echo view_var("page_header"); ?></h1>
   <div><?php get_template_part(views\content, view_var("template_name")); ?> </div>
   <?php
        foreach(view_var("some_data"), as $data) ...
   ?>


```

Voila, we can avoid handling things like queries, control structures and other more complex php code
in templates (as is common with Wordpress themes) and create prettier and reusable templates! 

visit our blog @ http://www.designplug.net/blog










