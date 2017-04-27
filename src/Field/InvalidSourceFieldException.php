<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Field;

use InvalidArgumentException;

/**
 * Exception thrown when a requested field does not exist.
 */
class InvalidSourceFieldException extends InvalidArgumentException
{
    /**
     * Create an exception for a field that has not been registered.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        parent::__construct(
            sprintf(
                'A source field with name %s has not been registered',
                $type
            )
        );
    }
}
