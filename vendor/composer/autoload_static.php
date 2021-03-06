<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdfbe3c6729e160290757408498f2b7a9
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'alfa\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'alfa\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdfbe3c6729e160290757408498f2b7a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdfbe3c6729e160290757408498f2b7a9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitdfbe3c6729e160290757408498f2b7a9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitdfbe3c6729e160290757408498f2b7a9::$classMap;

        }, null, ClassLoader::class);
    }
}
