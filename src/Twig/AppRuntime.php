<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use Psr\Cache\InvalidArgumentException;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    private MarkdownHelper $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function processMarkdown($value)
    {
        return $this->markdownHelper->parse($value);
    }
}