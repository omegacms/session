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
namespace Omega\Session\Exceptions;

/**
 * @use
 */
use RuntimeException;

/**
 * Cookie exception class.
 *
 * This `RuntimeException` serves as a base exception class for all cookie-related errors
 * within the Omega CMS Session Package.
 *
 * @category    Omega
 * @package     Omega\Cookie
 * @subpackage  Omega\Cookie\Exception
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */

class CookieException extends RuntimeException
{
}