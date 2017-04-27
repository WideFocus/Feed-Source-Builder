<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Validator\Logical;

use WideFocus\Feed\Source\Builder\Validator\ValidatorFactoryInterface;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\Logical\LogicalBoolValidator;
use WideFocus\Validator\Logical\LogicalOrValidator;

class LogicalOrValidatorFactory implements ValidatorFactoryInterface
{
    /**
     * Create a validator.
     *
     * @param ParameterBagInterface $constraints
     *
     * @return callable
     */
    public function create(ParameterBagInterface $constraints): callable
    {
        return new LogicalOrValidator(
            new LogicalBoolValidator($constraints->get('value', true))
        );
    }
}
