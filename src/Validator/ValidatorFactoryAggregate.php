<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Validator;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Contains a list of named validators.
 */
class ValidatorFactoryAggregate implements ValidatorFactoryAggregateInterface
{
    /**
     * @var ValidatorFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create a validator.
     *
     * @param string                $type
     * @param ParameterBagInterface $constraints
     *
     * @return callable
     *
     * @throws InvalidValidatorException When the validator is not registered.
     */
    public function create(
        string $type,
        ParameterBagInterface $constraints
    ): callable {
        if (!array_key_exists($type, $this->factories)) {
            throw new InvalidValidatorException($type);
        }

        return $this->factories[$type]
            ->create($constraints);
    }

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
    ) {
        $this->factories[$type] = $factory;
    }
}
