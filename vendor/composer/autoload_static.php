<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0d6819c3674ea3a7307cc10b8e654a7
{
    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsStream/src/main/php',
            ),
        ),
    );

    public static $classMap = array (
        'Mail' => __DIR__ . '/..' . '/adrianorsouza/codeigniter-phpmailer/application/libraries/Mail.php',
        'PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
        'POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.pop3.php',
        'SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.smtp.php',
        'phpmailerException' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitf0d6819c3674ea3a7307cc10b8e654a7::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf0d6819c3674ea3a7307cc10b8e654a7::$classMap;

        }, null, ClassLoader::class);
    }
}
