<?php

namespace TypiCMS\Modules\Dashboard\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements DashboardInterface
{
    public function __construct(DashboardInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    public function welcomeMessage()
    {
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale').'WelcomeMessage');

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $message = $this->repo->welcomeMessage();

        // Store in cache for next request
        $this->cache->put($cacheKey, $message);

        return $message;
    }
}
