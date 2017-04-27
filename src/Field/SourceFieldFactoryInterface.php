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
 * Creates source fields.
 */
interface SourceFieldFactoryInterface
{
    /**
     * Create a source field.
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
}
