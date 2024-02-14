<?php
/**
 * Part of Omega CMS -  Cookie Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 */

/**
 * @declare
 */
declare( strict_types = 1 );

/**
 * @namespace
 */
namespace Omega\Session\ServiceProvider;

/**
 * @use
 */
use Omega\Session\CookieFactory;
use Omega\Session\Storage\CookieStorage;
use Omega\ServiceProvider\AbstractServiceProvider;
use Omega\ServiceProvider\ServiceProviderInterface;

/**
 * CookieServiceProvider class.
 *
 * The `CookieServiceProvider` class is responsible for creating the CookieFactory instance
 * and defining the available drivers for the cookie service, such as the 'native' driver.
 *
 * @category    Omega
 * @package     Omega\Cookie
 * @subpackage  Omega\Cookie\ServiceProvider
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class CookieServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritdoc
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'cookie';
    }

    /**
     * @inheritdoc
     *
     * @return mixed
     */
    protected function factory() : ServiceProviderInterface
    {
        return new CookieFactory();
    }

    /**
     * @inheritdoc
     *
     * @return array Return an array of drivers for the service.
     */
    protected function drivers() : array
    {
        return [
            'native' => function ( $config ) {
                return new CookieStorage( $config );
            },
        ];
    }
}