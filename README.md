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

When the body has specified $body_class ControllerName::action will be called, which would
load data and pass it the view.

WXP/Theme/Controllers/ControllerName.php

```php namespace Theme\Controllers;
  
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

Now finally get your variables from your wordpress template

```html

   <h1>```php <?php echo view_var("page_header"); ?> ```</h1>
   <div> ```php <?php get_template_part(views\content, view_var("template_name")) ?>``` </div>
   ```php
   <?php
        foreach(view_var("some_data"), as $data) ...
   ?>
   ```


```











