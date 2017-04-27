<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Condition;

use InvalidArgumentException;

/**
 * Exception thrown when a requested condition does not exist.
 */
class InvalidSourceConditionException extends InvalidArgumentException
{
    /**
     * Create an exception for a condition that has not been registered.
     *
     * @param string $operator
     */
    public function __construct(string $operator)
    {
        parent::__construct(
            sprintf(
                'A source condition with name %s has not been registered',
                $operator
            )
        );
    }
}
