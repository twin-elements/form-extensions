<?php

namespace TwinElements\FormExtensions\Twig\ModuleUrlGenerator;

use Twig\Extension\RuntimeExtensionInterface;
use TwinElements\FormExtensions\Component\UrlBuilder\ModuleUrlBuilder;

class ModuleUrlGeneratorRuntime implements RuntimeExtensionInterface
{
    /**
     * @var ModuleUrlBuilder $moduleUrlBuilder
     */
    private $moduleUrlBuilder;

    public function __construct(ModuleUrlBuilder $moduleUrlBuilder)
    {
        $this->moduleUrlBuilder = $moduleUrlBuilder;
    }

    public function generateUrl(string $data)
    {
        return $this->moduleUrlBuilder->generateUrl($data);
    }
}
