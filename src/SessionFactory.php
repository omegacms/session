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
use Omega\Session\Storage\StorageInterface;
use Omega\Session\Exception\StorageException;
use Omega\Container\ServiceProvider\ServiceProviderInterface;

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
     * Array of registered session storage.
     *
     * @var array $storage Holds an array of registered session storage.
     */
    protected array $storage;

    /**
     * @inheritdoc
     *
     * @param  string  $alias  Holds the storage alias.
     * @param  Closure $driver Holds an instance of Closure to create the storage.
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
     * @param  array<string, mixed> $config An array of configuration options for the session.
     * @return StorageInterface
     * @throws StorageException If the session type is not defined or unrecognised.
     */
    public function bootstrap( array $config ) : StorageInterface
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new StorageException(
                'Type is not defined.'
            );
        }

        $type = $config[ 'type' ];

        if ( isset( $this->storage[ $type ] ) ) {
            return $this->storage[ $type ]( $config );
        }

        throw new StorageException(
            'Unrecognised type.'
        );
    }
}
