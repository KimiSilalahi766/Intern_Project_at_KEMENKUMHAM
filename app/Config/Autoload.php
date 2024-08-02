<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig   
{
    public $psr4 = [
        // Daftar PSR-4 autoloading
        'App'      => APPPATH, // Direkomendasikan
        'Config'   => APPPATH . 'Config',
        'PhpOffice\\PhpWord\\' => ROOTPATH . 'vendor/phpoffice/phpword/src/PhpWord',
    ];
    

    public $classmap = [];

    public $files = [];

    public $helpers = ['url', 'form', 'file'];
}
