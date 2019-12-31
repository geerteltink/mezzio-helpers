<?php

/**
 * @see       https://github.com/mezzio/mezzio-helpers for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-helpers/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-helpers/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Helper;

use Psr\Container\ContainerInterface;

use function sprintf;

class UrlHelperMiddlewareFactory
{
    /**
     * Create and return a UrlHelperMiddleware instance.
     *
     * @throws Exception\MissingHelperException if the UrlHelper service is
     *     missing
     */
    public function __invoke(ContainerInterface $container) : UrlHelperMiddleware
    {
        if (! $container->has(UrlHelper::class)
            && ! $container->has(\Zend\Expressive\Helper\UrlHelper::class)
        ) {
            throw new Exception\MissingHelperException(sprintf(
                '%s requires a %s service at instantiation; none found',
                UrlHelperMiddleware::class,
                UrlHelper::class
            ));
        }

        return new UrlHelperMiddleware($container->has(UrlHelper::class) ? $container->get(UrlHelper::class) : $container->get(\Zend\Expressive\Helper\UrlHelper::class));
    }
}
