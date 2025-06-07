<?php
// config/routes.php
// Definición de rutas de la aplicación
return [
    'home' => ['HomeController', 'index'],
    'show_form' => ['FormController', 'show'],
    'save_student' => ['FormController', 'save'],
    'edit_skill' => ['FormController', 'edit'],
    'update_skill' => ['FormController', 'update'],
    'delete_skill' => ['FormController', 'delete'],
    'login' => ['AuthController', 'showLogin'],
    'do_login' => ['AuthController', 'login'],
    'register' => ['AuthController', 'showRegister'],
    'do_register' => ['AuthController', 'register'],
    'logout' => ['AuthController', 'logout'],
    'set_lang' => ['HomeController', 'setLang'],
    'set_theme' => ['HomeController', 'setTheme'],
    'download_pdf' => ['FormController', 'downloadPdf']
];
