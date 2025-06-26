<?php

namespace Hub\Financial\services\Infrastructure\config;

use Hub\Financial\bricks\Core\config\EnvLoader;
use Illuminate\Database\Capsule\Manager as Capsule;
use Hub\Financial\bricks\Core\exception\ConfigurationNotImplementedException;

class RepositoryConfiguration
{
    public static function ConfigureRepository(EnvLoader $envLoader) : void
    {
        if(empty($envLoader->get('DB_DRIVER'))
            || empty($envLoader->get('DB_HOST'))
            || empty($envLoader->get('DB_BASE'))
            || empty($envLoader->get('DB_USER'))
            || empty($envLoader->get('DB_SENHA')))
            throw new ConfigurationNotImplementedException("Repository");

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => $envLoader->get('DB_DRIVER'),
            'host'      => $envLoader->get('DB_HOST'),
            'database'  => $envLoader->get('DB_BASE'),
            'username'  => $envLoader->get('DB_USER'),
            'password'  => $envLoader->get('DB_SENHA'),
            'charset'   => $envLoader->get('DB_CHARSET') ?? "utf8",
            'collation' => $envLoader->get('DB_COLLATION') ?? "utf8_unicode_ci",
            'prefix'    => $envLoader->get('DB_PREFIX') ?? ""
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}