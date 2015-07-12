<?php
namespace SamBurns\Psr11Symfony;

use Psr\Container\ContainerInterface;

class ServiceContainer implements ContainerInterface
{
    /**
     * @param string $serviceId
     * @return bool
     */
    public function has($serviceId)
    {
        return false;
    }

    /**
     * @param string $serviceId
     * @return mixed
     */
    public function get($serviceId)
    {
        return new \stdClass;
    }
}
