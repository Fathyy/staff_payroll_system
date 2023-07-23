<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita7c69ac01ae1c26d2196589d4d7f9368
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInita7c69ac01ae1c26d2196589d4d7f9368', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita7c69ac01ae1c26d2196589d4d7f9368', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita7c69ac01ae1c26d2196589d4d7f9368::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}