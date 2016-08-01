<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6f162280b5cc4cc59f273f2b0672f2f
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6f162280b5cc4cc59f273f2b0672f2f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6f162280b5cc4cc59f273f2b0672f2f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
