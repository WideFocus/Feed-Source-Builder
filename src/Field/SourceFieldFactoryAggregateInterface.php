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
interface SourceFieldFactoryAggregateInterface
{
    /**
     * Create a field.
     *
     * @param FeedFieldInterface    $feedField
     * @param ParameterBagInterface $sourceParameters
     *
     * @return SourceFieldInterface
     */
    public function create(
        FeedFieldInterface $feedField,
        ParameterBagInterface $sourceParameters
    ): SourceFieldInterface;

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
    );
}
