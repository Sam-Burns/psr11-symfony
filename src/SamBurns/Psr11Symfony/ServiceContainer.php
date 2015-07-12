<?php
namespace SamBurns\Psr11Symfony;

use Psr\Container\ContainerInterface;
use SamBurns\Psr11Symfony\Exception\NotFoundException;
use Symfony\Component\DependencyInjection\Container as SymfonyServiceContainer;

class ServiceContainer implements ContainerInterface
{
    /** @var SymfonyServiceContainer */
    private $symfonyServiceContainer;

    /**
     * @param SymfonyServiceContainer $symfonyServiceContainer
     */
    public function __construct(SymfonyServiceContainer $symfonyServiceContainer = null)
    {
        $this->symfonyServiceContainer = $symfonyServiceContainer ?: new SymfonyServiceContainer();
    }

    /**
     * @param string $pathToFolder
     */
    public function addConfigFilesFromFolder($pathToFolder)
    {

    }

    /**
     * @param string $serviceId
     * @return bool
     */
    public function has($serviceId)
    {
        return $this->symfonyServiceContainer->has($serviceId);
    }

    /**
     * @throws NotFoundException
     *
     * @param string $serviceId
     * @return mixed
     */
    public function get($serviceId)
    {
        if (!$this->has($serviceId)) {
            throw NotFoundException::constructWithThingNotFound($serviceId);
        }
        return $this->symfonyServiceContainer->get($serviceId);
    }
}
