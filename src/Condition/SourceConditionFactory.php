<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Condition;

use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Source\Builder\Source\ValueSourceFactoryInterface;
use WideFocus\Feed\Source\Builder\Validator\ValidatorFactoryAggregateInterface;
use WideFocus\Feed\Source\Condition\SourceCondition;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Parameters\ParameterBagInterface;

class SourceConditionFactory implements SourceConditionFactoryInterface
{
    /**
     * @var ValidatorFactoryAggregateInterface
     */
    private $validatorFactory;

    /**
     * @var ValueSourceFactoryInterface
     */
    private $valueSourceFactory;

    /**
     * Constructor.
     *
     * @param ValidatorFactoryAggregateInterface $validatorFactory
     * @param ValueSourceFactoryInterface        $valueSourceFactory
     */
    public function __construct(
        ValidatorFactoryAggregateInterface $validatorFactory,
        ValueSourceFactoryInterface $valueSourceFactory
    ) {
        $this->validatorFactory   = $validatorFactory;
        $this->valueSourceFactory = $valueSourceFactory;
    }

    /**
     * Create a source condition.
     *
     * @param FeedConditionInterface $feedCondition
     * @param ParameterBagInterface  $sourceParameters
     *
     * @return SourceConditionInterface
     */
    public function create(
        FeedConditionInterface $feedCondition,
        ParameterBagInterface $sourceParameters
    ): SourceConditionInterface {
        return new SourceCondition(
            $this->valueSourceFactory->create($sourceParameters),
            $this->validatorFactory->create(
                $feedCondition->getOperator(),
                $feedCondition->getConstraints()
            ),
            $feedCondition->getName()
        );
    }
}
