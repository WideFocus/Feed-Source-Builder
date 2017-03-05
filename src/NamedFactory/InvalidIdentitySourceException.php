<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\NamedFactory;

use InvalidArgumentException;

/**
 * Exception thrown when a requested identity source does not exist.
 */
class InvalidIdentitySourceException extends InvalidArgumentException
{
    /**
     * Create an exception for a source that has not been registered.
     *
     * @param string $name
     *
     * @return InvalidIdentitySourceException
     */
    public static function notRegistered(
        string $name
    ): InvalidIdentitySourceException {
        return new static(
            sprintf(
                'An identity source with name %s has not been registered',
                $name
            )
        );
    }
}
