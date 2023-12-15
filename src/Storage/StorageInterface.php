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
 * StorageInterface.
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
interface StorageInterface
{
    /**
     * Tell if a value is session
     *
     * @param  string $key Holds the session key.
     * @return bool Return true if the session exists.
     */
    public function has( string $key ) : bool;

    /**
     * Get a session value.
     *
     * @param  string $key     Holds the session key.
     * @param  mixed  $default Holds the default value or null.
     * @return mixed
     */
    public function get( string $key, mixed $default = null ) : mixed;

    /**
     * Put a value into the session.
     *
     * @param  string $key   Holds the session key.
     * @param  mixed  $value Holds the session value.
     * @return $this
     */
    public function put( string $key, mixed $value ) : static;

    /**
     * Remove a single session value.
     *
     * @param  string $key Holds the session key.
     * @return $this
     */
    public function forget( string $key ) : static;

    /**
     * Remove all session values.
     *
     * @return $this
     */
    public function flush() : static;
}