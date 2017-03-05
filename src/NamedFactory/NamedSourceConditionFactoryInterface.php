<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\NamedFactory;

use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionFactoryInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates source conditions by name.
 */
interface NamedSourceConditionFactoryInterface
{
    const COMBINATION_NAME = 'combination';

    /**
     * Create a condition.
     *
     * @param string                    $name
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionInterface
     */
    public function createCondition(
        string $name,
        SourceParametersInterface $parameters
    ): SourceConditionInterface;

    /**
     * Create a combination condition.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionCombinationInterface
     */
    public function createCombinationCondition(
        SourceParametersInterface $parameters
    ): SourceConditionCombinationInterface;

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
    );
}
