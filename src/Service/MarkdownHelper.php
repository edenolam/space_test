<?php
namespace App\Service;

use Michelf\MarkdownInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

// to not re-parse the same markdown content over and over again.
// Basically, we want to be able to use a markdown filter in Twig,
// but we want it to use our MarkdownHelper service,
// instead of the uncached service from the bundle.
class MarkdownHelper
{
    private AdapterInterface $cache;
    private MarkdownInterface $markdown;
    private LoggerInterface $logger;
    private bool $isDebug;

    public function __construct(
        AdapterInterface $cache,
        MarkdownInterface $markdown,
        LoggerInterface $markdownLogger,
        bool $isDebug
    )
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $markdownLogger;
        $this->isDebug = $isDebug;
    }


    /**
     * @throws InvalidArgumentException
     */
    public function parse(string $source)
    {
        if (stripos($source, 'bacon') !== false){
            $this->logger->info('They are talking about bacon again');
        }

        // skip caching entirely in debug
        if ($this->isDebug){
            return $this->markdown->transform($source);
        }

        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()){
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}