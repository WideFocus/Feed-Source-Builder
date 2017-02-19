<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Manager;

use InvalidArgumentException;

/**
 * Exception thrown when a requested condition does not exist.
 */
class InvalidSourceConditionException extends InvalidArgumentException
{
    /**
     * Create an exception for a condition that has not been registered.
     *
     * @param string $name
     *
     * @return InvalidSourceConditionException
     */
    public static function notRegistered(
        string $name
    ): InvalidSourceConditionException {
        return new static(
            sprintf(
                'A source condition with name %s has not been registered',
                $name
            )
        );
    }
}
