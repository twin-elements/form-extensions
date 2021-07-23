<?php

namespace TwinElements\FormExtensions\Component\UrlBuilder;

class ModuleUrlBuilder
{
    /**
     * @var ModuleUrlGeneratorFactory $urlGeneratorFactory
     */
    private $urlGeneratorFactory;

    public function __construct(ModuleUrlGeneratorFactory $urlGeneratorFactory)
    {
        $this->urlGeneratorFactory = $urlGeneratorFactory;
    }

    public function generateUrl(string $data)
    {
        $encodedData = json_decode($data);
        if (json_last_error() === JSON_ERROR_NONE) {
            /**
             * @var ModuleUrlGeneratorInterface $urlGenerator
             */
            $urlGenerator = $this->urlGeneratorFactory->getModule($encodedData->moduleId);

            return $urlGenerator->generateUrl($encodedData->linkId);
        } else {
            return $data;
        }
    }
}
