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
namespace Omega\Session\Storage;

/**
 * @use
 */
use function array_keys;
use function extension_loaded;
use function str_starts_with;
use function Omega\Helpers\config;
use LogicException;

/**
 * Cookie storage class.
 *
 * The `CookieStorage` provides native cookie storage using PHP's built-in cookie handling.
 *
 * @category    Omega
 * @package     Omega\Cookie
 * @subpackage  Omega\Cookie\Storage
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class CookieStorage extends AbstractStorage
{ 
    /**
     * Configuration array.
     *
     * @var array $config Holds an array of configuration parameters.
     */
    private array $config;

    /**
     * CookieStorage constructor.
     *
     * @param  array $config Holds an array of configuration parameters.
     * @return void
     */
    public function __construct( array $config )
    {
        $this->config = $config;
    }

    /**
     * @inheritdoc
     *
     * @param  string $key The cookie key.
     * @return bool Return true if the cookie value exists.
     */
    public function has( string $key ) : bool
    {
        return isset( $_COOKIE[ $key ] );
    }

    /**
     * @inheritdoc
     *
     * @param  string $key     The cookie key.
     * @param  mixed  $default The default value to return if the key is not found.
     * @return mixed Return the cookie value or the default value if the key is not found.
     */
    public function get( string $key, mixed $default = null ) : mixed
    {
        return $this->has( $key ) ? $_COOKIE[ $key ] : $default;
    }

    /**
     * @inheritdoc
     *
     * @param  string $key   The cookie key.
     * @param  mixed  $value The cookie value.
     * @return $this
     */
    public function put( string $key, mixed $value ) : static
    {
        $expire = time() + ($this->config['expire'] ?? 0);
        setcookie($key, $value, $expire, $this->config['path'] ?? '/', $this->config['domain'] ?? '', $this->config['secure'] ?? false, $this->config['httponly'] ?? false);

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @param  string $key The cookie key.
     * @return $this
     */
    public function forget( string $key ) : static
    {
        if ( $this->has( $key ) ) {
            setcookie( $key, '', time() - 3600, $this->config[ 'path' ] ?? '/', $this->config[ 'domain' ] ?? '' );
            unset( $_COOKIE[ $key ] );
        }

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @return $this
     */
    public function flush() : static
    {
        foreach ( array_keys( $_COOKIE ) as $key ) {
            $this->forget( $key );
        }

        return $this;
    }
}