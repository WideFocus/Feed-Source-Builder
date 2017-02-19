<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Manager;

use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionFactoryInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Manages source conditions.
 */
class SourceConditionManager implements SourceConditionManagerInterface
{
    /**
     * @var SourceConditionFactoryInterface[]
     */
    private $factories = [];

    /**
     * Constructor.
     *
     * @param SourceConditionFactoryInterface $combinationFactory
     */
    public function __construct(
        SourceConditionFactoryInterface $combinationFactory
    ) {
        $this->addConditionFactory(
            $combinationFactory,
            self::COMBINATION_NAME
        );
    }

    /**
     * Create a condition.
     *
     * @param string                    $name
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionInterface
     *
     * @throws InvalidSourceConditionException When the condition does not exist.
     */
    public function createCondition(
        string $name,
        SourceParametersInterface $parameters
    ): SourceConditionInterface {
        if (!array_key_exists($name, $this->factories)) {
            throw InvalidSourceConditionException::notRegistered($name);
        }
        return $this->factories[$name]
            ->createCondition($parameters);
    }

    /**
     * Get the combination condition.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionCombinationInterface
     */
    public function createCombinationCondition(
        SourceParametersInterface $parameters
    ): SourceConditionCombinationInterface
    {
        /** @var SourceConditionCombinationInterface $condition */
        $condition = $this->createCondition(
            self::COMBINATION_NAME,
            $parameters
        );
        return $condition;
    }

    /**
     * Add a condition factory.
     *
     * @param SourceConditionFactoryInterface $factory
     * @param string                          $name
     *
     * @return void
     */
    public function addConditionFactory(
        SourceConditionFactoryInterface $factory,
        string $name
    ) {
        $this->factories[$name] = $factory;
    }
}
