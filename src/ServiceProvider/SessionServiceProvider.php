<?php
/**
 * Part of Omega CMS -  Validation Package
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
use Omega\Session\SessionFactory;
use Omega\Session\Storage\NativeStorage;
use Omega\ServiceProvider\AbstractServiceProvider;
use Omega\ServiceProvider\ServiceProviderInterface;

/**
 * SessionServiceProvider class.
 *
 * @category    Omega
 * @package     Omega\Session
 * @subpackage  Omega\Session\ServiceProvider
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class SessionServiceProvider extends AbstractServiceProvider
{
    /**
     * Get the service name.
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'session';
    }

    /**
     * Get the service factory.
     *
     * @return mixed
     */
    protected function factory() : ServiceProviderInterface
    {
        return new SessionFactory();
    }

    /**
     * Get drivers.
     *
     * @return array Return an array of drivers for the service.
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