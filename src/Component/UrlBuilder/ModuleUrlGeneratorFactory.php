<?php

namespace TwinElements\FormExtensions\Component\UrlBuilder;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ModuleUrlGeneratorFactory
{
    /**
     * @var ModuleUrlGeneratorInterface[]
     */
    private $urlGenerators;

    public function __construct($urlGenerators)
    {
        /**
         * @var UrlGeneratorInterface $urlGenerator
         */
        foreach ($urlGenerators as $urlGenerator) {
            $this->urlGenerators[$urlGenerator::getName()] = $urlGenerator;
        }
    }

    public function getUrlGenerators()
    {
        return $this->urlGenerators;
    }

    public function getModule(string $name)
    {
        return $this->urlGenerators[$name];
    }
}
