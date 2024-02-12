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
namespace Omega\Session\Storage;

/**
 * @use
 */
use function array_keys;
use function session_start;
use function session_status;
use function str_starts_with;
use function Omega\Helpers\dump;
use function Omega\Helpers\config;

/**
 * Native driver class.
 *
 * The `NativeDrovides` provides native session storage using PHP's built-in session handling.
 *
 * @category    Omega
 * @package     Omega\Session
 * @subpackage  Omega\Session\Storage
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class NativeStorage extends AbstractStorage
{
    /**
     * Configuration array.
     *
     * @var array $config Holds an array of configuration parameters.
     */
    private array $config;

    /**
     * NativeStorage constructor.
     *
     * @param  array $config Holds an array of configuration parameters.
     * @return void
     */
    public function __construct( array $config )
    {
        if ( session_status() !== PHP_SESSION_ACTIVE ) {
            session_start();
        }

        $this->config = $config;

        dump( $config );
    }

    /**
     * @inheritdoc
     *
     * @param  string $key The session key.
     * @return bool Return true if the session value exists.
     */
    public function has( string $key ) : bool
    {
        $prefix = $this->config[ 'prefix' ];

        return isset( $_SESSION[ "{$prefix}{$key}" ] );
    }

    /**
     * @inheritdoc
     *
     * @param  string $key     The session key.
     * @param  mixed  $default The default value to return if the key is not found.
     * @return mixed Return the session value or the default value if the key is not found.
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
     * @inheritdoc
     *
     * @param  string $key   The session key.
     * @param  mixed  $value The session value.
     * @return $this
     */
    public function put( string $key, mixed $value ) : static
    {
        $prefix = $this->config[ 'prefix' ];
        $_SESSION[ "{$prefix}{$key}" ] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @param  string $key The session key.
     * @return $this
     */
    public function forget( string $key ) : static
    {
        $prefix = $this->config[ 'prefix' ];

        unset( $_SESSION[ "{$prefix}{$key}" ] );

        return $this;
    }

    /**
     * @inheritdoc
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