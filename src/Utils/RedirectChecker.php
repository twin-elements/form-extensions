<?php

namespace TwinElements\FormExtensions\Utils;

use TwinElements\FormExtensions\Component\UrlBuilder\ModuleUrlBuilder;

class RedirectChecker
{
    private ModuleUrlBuilder $urlBuilder;
    private ?string $url = null;

    public function __construct(ModuleUrlBuilder $moduleUrlBuilder)
    {
        $this->urlBuilder = $moduleUrlBuilder;
    }

    public function check(?string $redirect): bool
    {
        if (is_null($redirect)) {
            return false;
        }

        $this->url = $this->urlBuilder->generateUrl($redirect);
        return true;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
