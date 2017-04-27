<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Source;

use InvalidArgumentException;

/**
 * Exception thrown when a requested identity source does not exist.
 */
class InvalidIdentitySourceException extends InvalidArgumentException
{
    /**
     * Create an exception for a source that has not been registered.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        parent::__construct(
            sprintf(
                'An identity source with name %s has not been registered',
                $type
            )
        );
    }
}
