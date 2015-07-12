<?php
namespace SamBurns\Psr11Symfony;

use Psr\Container\ContainerInterface;
use SamBurns\Psr11Symfony\Exception\NotFoundException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyServiceContainer;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

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
        $filenames = $this->getConfigFilenames($pathToFolder);

        $loader = new YamlFileLoader($this->symfonyServiceContainer, new FileLocator($pathToFolder));

        foreach ($filenames as $filename) {
            $loader->load($filename);
        }
    }

    /**
     * @param string $pathToFolder
     * @return string[]
     */
    private function getConfigFilenames($pathToFolder)
    {
        $filesInFolder = array();

        $lsResults = scandir($pathToFolder);

        foreach ($lsResults as $lsResult) {
            $fullPath = $pathToFolder . $lsResult;
            if (is_file($fullPath)) {
                $filesInFolder[] = $lsResult;
            }
        }

        return $filesInFolder;
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
