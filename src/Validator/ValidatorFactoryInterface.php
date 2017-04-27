<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Validator;

use WideFocus\Parameters\ParameterBagInterface;

interface ValidatorFactoryInterface
{
    /**
     * Create a validator.
     *
     * @param ParameterBagInterface $constraints
     *
     * @return callable
     */
    public function create(
        ParameterBagInterface $constraints
    ): callable;
}
