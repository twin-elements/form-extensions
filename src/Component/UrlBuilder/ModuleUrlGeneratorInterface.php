<?php


namespace TwinElements\FormExtensions\Component\UrlBuilder;


interface ModuleUrlGeneratorInterface
{
    public function generateUrl(int $id);

    public function getUrlList();

    public static function getName(): string;
}
