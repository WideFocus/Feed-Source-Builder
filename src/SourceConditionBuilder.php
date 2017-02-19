<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\Condition\FeedConditionInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Manager\SourceConditionManagerInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source conditions based on feeds.
 */
class SourceConditionBuilder implements SourceConditionBuilderInterface
{
    /**
     * @var SourceConditionManagerInterface
     */
    private $conditionManager;

    /**
     * Constructor.
     *
     * @param SourceConditionManagerInterface $conditionManager
     */
    public function __construct(SourceConditionManagerInterface $conditionManager)
    {
        $this->conditionManager = $conditionManager;
    }

    /**
     * Build a source condition based on a feed.
     *
     * @param FeedInterface             $feed
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionCombinationInterface
     */
    public function buildConditions(
        FeedInterface $feed,
        SourceParametersInterface $parameters
    ): SourceConditionCombinationInterface {
        $combination = $this->conditionManager
            ->createCombinationCondition($parameters);

        $combination->setOperator(SourceConditionCombinationInterface::OPERATOR_AND);

        $this->addConditionsToCombination(
            $combination,
            $feed->getConditions(),
            $parameters
        );
        return $combination;
    }

    /**
     * Add the feed conditions to a combination.
     *
     * @param SourceConditionCombinationInterface $combination
     * @param FeedConditionInterface[]            $feedConditions
     * @param SourceParametersInterface           $parameters
     */
    protected function addConditionsToCombination(
        SourceConditionCombinationInterface $combination,
        array $feedConditions,
        SourceParametersInterface $parameters
    ) {
        foreach ($feedConditions as $feedCondition) {
            $condition = $this->createCondition($feedCondition, $parameters);
            $combination->addCondition($condition);

            if ($condition instanceof SourceConditionCombinationInterface) {
                $this->addConditionsToCombination(
                    $condition,
                    $feedCondition->getChildren(),
                    $parameters
                );
            }
        }
    }

    /**
     * Build a source condition based on a feed condition.
     *
     * @param FeedConditionInterface    $feedCondition
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionInterface
     */
    protected function createCondition(
        FeedConditionInterface $feedCondition,
        SourceParametersInterface $parameters
    ): SourceConditionInterface {
        $condition = $this->conditionManager->createCondition(
            $feedCondition->getType(),
            $parameters
        );

        $condition->setAttributeCode($feedCondition->getName());
        $condition->setOperator($feedCondition->getOperator());
        $condition->setValue($feedCondition->getValue());
        return $condition;
    }
}
