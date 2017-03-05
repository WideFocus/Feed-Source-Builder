<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\NamedFactory;

use InvalidArgumentException;

/**
 * Exception thrown when a requested field does not exist.
 */
class InvalidSourceFieldException extends InvalidArgumentException
{
    /**
     * Create an exception for a field that has not been registered.
     *
     * @param string $name
     *
     * @return InvalidSourceFieldException
     */
    public static function notRegistered(
        string $name
    ): InvalidSourceFieldException {
        return new static(
            sprintf(
                'A source field with name %s has not been registered',
                $name
            )
        );
    }
}
