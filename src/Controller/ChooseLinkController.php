<?php

namespace TwinElements\FormExtensions\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use TwinElements\FormExtensions\Component\UrlBuilder\ModuleUrlGeneratorFactory;
use TwinElements\FormExtensions\Component\UrlBuilder\ModuleUrlGeneratorInterface;

class ChooseLinkController extends AbstractController
{
    private $urlGeneratorFactory;

    /**
     * @param $urlGeneratorFactory
     */
    public function __construct(ModuleUrlGeneratorFactory $urlGeneratorFactory)
    {
        $this->urlGeneratorFactory = $urlGeneratorFactory;
    }

    public function generateListOfLinksAction()
    {
        $modules = [];
        /**
         * @var ModuleUrlGeneratorInterface $urlGenerator
         */
        foreach ($this->urlGeneratorFactory->getUrlGenerators() as $urlGeneratorName => $urlGenerator) {
            $modules[$urlGeneratorName] = $urlGenerator->getUrlList();
        }

        return $this->render('@TwinElementsFormExtensions/list-of-links.html.twig', [
            'modules' => $modules
        ]);
    }
}
