<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Validator;

use InvalidArgumentException;

/**
 * Exception thrown when a requested validator does not exist.
 */
class InvalidValidatorException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $operator
     */
    public function __construct(string $operator)
    {
        parent::__construct(
            sprintf('A validator for operator %s has not been registered', $operator)
        );
    }
}
