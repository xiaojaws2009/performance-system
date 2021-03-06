<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit427a14d4dc065910023fe569a36e1f14
{
    public static $files = array (
        '7844cce90d4037f1a077c08319eef109' => __DIR__ . '/..' . '/react/promise/src/React/Promise/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Medoo\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Medoo\\' => 
        array (
            0 => __DIR__ . '/..' . '/catfan/medoo/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'React\\Stream' => 
            array (
                0 => __DIR__ . '/..' . '/react/stream',
            ),
            'React\\Stomp' => 
            array (
                0 => __DIR__ . '/..' . '/react/stomp/src',
            ),
            'React\\Socket' => 
            array (
                0 => __DIR__ . '/..' . '/react/socket',
            ),
            'React\\Promise' => 
            array (
                0 => __DIR__ . '/..' . '/react/promise/src',
            ),
            'React\\EventLoop' => 
            array (
                0 => __DIR__ . '/..' . '/react/event-loop',
            ),
        ),
        'E' => 
        array (
            'Evenement' => 
            array (
                0 => __DIR__ . '/..' . '/evenement/evenement/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit427a14d4dc065910023fe569a36e1f14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit427a14d4dc065910023fe569a36e1f14::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit427a14d4dc065910023fe569a36e1f14::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
