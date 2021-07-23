<?php

namespace TwinElements\FormExtensions\Twig\ModuleUrlGenerator;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ModuleUrlGeneratorExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('generateModuleUrl', [ModuleUrlGeneratorRuntime::class, 'generateUrl'])
        ];
    }
}
