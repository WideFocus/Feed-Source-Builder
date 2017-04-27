<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Field;

use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates source fields by name.
 */
class SourceFieldFactoryAggregate implements SourceFieldFactoryAggregateInterface
{
    /**
     * @var SourceFieldFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create a field.
     *
     * @param FeedFieldInterface    $feedField
     * @param ParameterBagInterface $sourceParameters
     *
     * @return SourceFieldInterface
     *
     * @throws InvalidSourceFieldException When the field type has not
     *  been registered.
     */
    public function create(
        FeedFieldInterface $feedField,
        ParameterBagInterface $sourceParameters
    ): SourceFieldInterface {
        $type = $feedField->getType();
        if (!array_key_exists($type, $this->factories)) {
            throw new InvalidSourceFieldException($type);
        }

        return $this->factories[$type]
            ->create($feedField, $sourceParameters);
    }

    /**
     * Add a field factory.
     *
     * @param string                      $type
     * @param SourceFieldFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(
        string $type,
        SourceFieldFactoryInterface $factory
    ) {
        $this->factories[$type] = $factory;
    }
}
