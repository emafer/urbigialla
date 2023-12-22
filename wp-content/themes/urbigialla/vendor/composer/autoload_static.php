<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit408daede4327fd876212f0dc3164edeb
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit408daede4327fd876212f0dc3164edeb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit408daede4327fd876212f0dc3164edeb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit408daede4327fd876212f0dc3164edeb::$classMap;

        }, null, ClassLoader::class);
    }
}