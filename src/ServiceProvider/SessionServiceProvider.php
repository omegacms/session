<?php
/**
 * Part of Omega CMS -  Session Package
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
use function Omega\Helpers\dump;
use Omega\Session\SessionFactory;
use Omega\Session\Storage\NativeStorage;
use Omega\ServiceProvider\AbstractServiceProvider;
use Omega\ServiceProvider\ServiceProviderInterface;

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
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
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
     * @return mixed
     */
    protected function factory() : ServiceProviderInterface
    {
        return new SessionFactory();
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
                return new NativeStorage( $config );
            },
        ];
    }
}