<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Validator;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Contains a list of validator factories.
 */
interface ValidatorFactoryAggregateInterface
{
    /**
     * Create a validator.
     *
     * @param string                $type
     * @param ParameterBagInterface $constraints
     *
     * @return callable
     */
    public function create(
        string $type,
        ParameterBagInterface $constraints
    ): callable;

    /**
     * Add a validator factory.
     *
     * @param string                    $type
     * @param ValidatorFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(
        string $type,
        ValidatorFactoryInterface $factory
    );
}
