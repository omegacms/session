<?php
/**
 * Part of Omega CMS -  Session Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
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
use Closure;
use Omega\Session\SessionFactory;
use Omega\Session\Storage\NativeStorage;
use Omega\Container\ServiceProvider\AbstractServiceProvider;
use Omega\Container\ServiceProvider\ServiceProviderInterface;

/**
 * SessionServiceProvider class.
 *
 * The `SessionServiceProvider` class is responsible for creating the SessionFactory instance
 * and defining the available drivers for the session service, such as the 'native' driver.
 *
 * @category    Omega
 * @package     Omega\Session
 * @subpackage  Omega\Session\ServiceProvider
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class SessionServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritdoc
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'session';
    }

    /**
     * @inheritdoc
     *
     * @return ServiceProviderInterface Return an instance of ServiceProviderInterface.
     */
    protected function factory() : ServiceProviderInterface
    {
        return new SessionFactory();
    }

    /**
     * @inheritdoc
     *
     * @return array<string, Closure> Return an array of drivers for the service.
     */
    protected function drivers() : array
    {
        return [
            'native' => function ( $config ) {
                return new NativeStorage( $config );
            },
        ];
    }
}