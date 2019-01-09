**Warning:** Works only with CakePHP 2.x!

CakePHP 2.x Helpers for Bootstrap 4
===================================

CakePHP Helpers to generate HTML with @Twitter Boostrap 4 style.

<i>Based on the Plugin by https://github.com/Holt59/cakephp-bootstrap3-helpers</i>

Do not hesitate to...
 - **Post a github issue** if you find a bug or want a new feature.
 - **Send me a message** if you have troubles installing or using the plugin.

Installation
============

Simply Clone the repository in your `app/Plugin/Bootstrap4` folder and add the following to your `app/Config/bootstrap.php`:

```php
CakePlugin::load('Bootstrap4') ;
```

How to use?
===========

Just load the helpers in you controller:
```php
public $helpers = array(
    'Html' => array(
        'className' => 'Bootstrap4.BootstrapHtml'
    ),
    'Form' => array(
        'className' => 'Bootstrap4.BootstrapForm'
    ),
    'Modal' => array(
        'className' => 'Bootstrap4.BootstrapModal'
    )
);
```
