<?php

namespace src;

class Container
{
    private array $config;

    private static ?Container $container = null;

    private static array $components = [];

    /**
     * @param $config
     *
     * @return Container
     * @throws \Exception
     */
    public static function create($config): Container
    {
        if (null == self::$container) {
            self::$container = new Container($config);
            self::$container->createComponents();
        }

        return self::$container;
    }

    public static function get($name)
    {
        return self::$components[$name] ?? null;
    }

    private function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @throws \Exception
     */
    private function createComponents(): void
    {
        foreach ($this->config as $class => $component) {
            self::$components[$class] = $this->resolve($this->config, $class, $component['dependencies']);
        }
    }

    /**
     * @param $config
     * @param $class
     * @param $dependencies
     *
     * @return mixed
     * @throws \Exception
     */
    private function resolve($config, $class, $dependencies)
    {
        $object = new $class();
        foreach ($dependencies as $key => $dependency) {
            if (!method_exists($object, 'set' . $key)) {
                throw new \Exception('Invalid config ' . $key . ' ' . $class);
            }

            $resolved = null;
            if (!is_string($dependency)) {
                $resolved = $dependency;
            } else {
                if (class_exists($dependency)) {
                    if (!empty($config[$dependency])) {
                        $resolved = $this->resolve($config, $dependency, $config[$dependency]['dependencies']);
                    } else {
                        $resolved = new $dependency();
                    }
                } elseif (empty($config[$dependency])) {
                    $resolved = $dependency;
                }
            }

            $object->{'set' . $key}($resolved);
        }

        return $object;
    }
}
