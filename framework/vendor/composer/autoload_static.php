<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit813f1353ed7a371b6dadf0bc8baa5a4f
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sys\\' => 4,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sys\\' => 
        array (
            0 => __DIR__ . '/../..' . '/system/library',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit813f1353ed7a371b6dadf0bc8baa5a4f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit813f1353ed7a371b6dadf0bc8baa5a4f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}