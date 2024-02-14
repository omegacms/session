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
namespace Omega\Session;

/**
 * @use
 */
use Closure;
use Omega\Session\Storage\StorageInterface;
use Omega\Session\Exceptions\CookieException;
use Omega\ServiceProvider\ServiceProviderInterface;

/**
 * CookieFactory class.
 *
 * The `CookieFactory` class serves as a factory for creating and managing
 * different cookie drivers. It allows you to register and bootstrap
 * various cookie storage drivers based on your configuration.
 *
 * @category    Omega
 * @package     Omega\Cookie
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class CookieFactory implements ServiceProviderInterface
{
    /**
     * Array of registered cookie storage.
     *
     * @var array $storage Holds an array of registered cookie storage.
     */
    protected array $storage;

    /**
     * @inheritdoc
     *
     * @param  string  $alias   Holds the storage alias.
     * @param  Closure $storage Holds an instance of Closure to create the storage.
     * @return $this
     */
    public function register( string $alias, Closure $driver ) : static
    {
        $this->storage[ $alias ] = $driver;

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
            throw new CookieException(
                'Type is not defined.'
            );
        }

        $type = $config[ 'type' ];
        
        if ( isset( $this->storage[ $type ] ) ) {
            return $this->storage[ $type ]( $config );
        }

        throw new CookieException(
            'Unrecognised type.'
        );
    }
}