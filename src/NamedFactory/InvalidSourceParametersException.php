<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\NamedFactory;

use InvalidArgumentException;

/**
 * Exception thrown when a requested parameters object has not been registered.
 */
class InvalidSourceParametersException extends InvalidArgumentException
{
    /**
     * Create an exception for a source parameters object that has not been
     * registered.
     *
     * @param string $name
     *
     * @return InvalidSourceParametersException
     */
    public static function notRegistered(
        string $name
    ): InvalidSourceParametersException {
        return new static(
            sprintf(
                'A source parameters object with name %s has not been registered',
                $name
            )
        );
    }
}
