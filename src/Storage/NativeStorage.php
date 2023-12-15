<?php
/**
 * Part of Banco Omega CMS -  Session Package
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
namespace Omega\Session\Storage;

/**
 * @use
 */
use function array_keys;
use function config;
use function str_starts_with;

/**
 * Native driver class.
 *
 * @category    Omega
 * @package     Omega\Session
 * @subpackage  Omega\Session\Storage
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class NativeStorage extends AbstractStorage
{
    /**
     * Config array.
     *
     * @var array $config Holds an array of config.
     */
    private array $config;

    /**
     * Native class constructor.
     *
     * @param  array $config Holds an array of configuration params.
     * @return void
     */
    public function __construct( array $config )
    {
        $this->config = $config;

        /*"if ( session_status() !== PHP_SESSION_ACTIVE ) {
            session_start();
        }*/
    }

    /**
     * Tell if a value is session
     *
     * @param  string $key Holds the session key.
     * @return bool Return true if the session exists.
     */
    public function has( string $key ) : bool
    {
        $prefix = $this->config[ 'prefix' ];

        return isset( $_SESSION[ "{$prefix}{$key}" ] );
    }

    /**
     * Get a session value.
     *
     * @param  string $key     Holds the session key.
     * @param  mixed  $default Holds the default value or null.
     * @return mixed
     */
    public function get( string $key, mixed $default = null ) : mixed
    {
        $prefix = $this->config[ 'prefix' ];

        if ( isset( $_SESSION[ "{$prefix}{$key}" ] ) ) {
            return $_SESSION[ "{$prefix}{$key}" ];
        }

        return $default;
    }

    /**
     * Put a value into the session.
     *
     * @param  string $key   Holds the session key.
     * @param  mixed  $value Holds the session value.
     * @return $this
     */
    public function put( string $key, mixed $value ) : static
    {
        $prefix = $this->config[ 'prefix' ];
        $_SESSION[ "{$prefix}{$key}" ] = $value;

        return $this;
    }

    /**
     * Remove a single session value.
     *
     * @param  string $key Holds the session key.
     * @return $this
     */
    public function forget( string $key ) : static
    {
        $prefix = $this->config[ 'prefix' ];

        unset( $_SESSION[ "{$prefix}{$key}" ] );

        return $this;
    }

    /**
     * Remove all session values.
     *
     * @return $this
     */
    public function flush() : static
    {
        foreach ( array_keys( $_SESSION ) as $key ) {
            $prefix = config( 'session.native.prefix' );
            if ( str_starts_with( $key, $prefix ) ) {
                unset( $_SESSION[ $key ] );
            }
        }

        return $this;
    }
}
