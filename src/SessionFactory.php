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
namespace Omega\Session;

/**
 * @use
 */
use Closure;
use Omega\ServiceProvider\ServiceProviderInterface;
use Omega\Session\Storage\StorageInterface;
use Omega\Session\Exceptions\SessionException;

/**
 * SessionFactory class.
 *
 * The `SessionFactory` class serves as a factory for creating and managing
 * different session drivers. It allows you to register and bootstrap
 * various session storage drivers based on your configuration.
 *
 * @category    Omega
 * @package     Omega\Session
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class SessionFactory implements ServiceProviderInterface
{
    /**
     * Array of registered session drivers.
     *
     * @var array $drivers Holds an array of drivers.
     */
    protected array $drivers;


    /**
     * @inheritdoc
     *
     * @param  string  $alias  The driver alias.
     * @param  Closure $driver An instance of Closure to create the driver.
     * @return $this
     */
    public function register( string $alias, Closure $driver ) : static
    {
        $this->drivers[ $alias ] = $driver;

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @param  array $config An array of configuration options for the session.
     * @return StorageInterface
     * @throws SessionException If the session type is not defined or unrecognised.
     */
    public function bootstrap( array $config ) : StorageInterface
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new SessionException(
                'Type is not defined.'
            );
        }

        $type = $config[ 'type' ];

        if ( isset( $this->drivers[ $type ] ) ) {
            return $this->drivers[ $type ]( $config );
        }

        throw new SessionException(
            'Unrecognised type.'
        );
    }
}