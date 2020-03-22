<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf761f0663eba83ef1bc4860c52834f7a
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'NeutronStandard\\' => 16,
        ),
        'I' => 
        array (
            'Inc\\' => 4,
        ),
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'NeutronStandard\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/phpcs-neutron-standard/NeutronStandard',
        ),
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf761f0663eba83ef1bc4860c52834f7a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf761f0663eba83ef1bc4860c52834f7a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
