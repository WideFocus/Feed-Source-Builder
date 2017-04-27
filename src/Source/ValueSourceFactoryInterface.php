<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Source;

use WideFocus\Feed\Source\ValueSourceInterface;
use WideFocus\Parameters\ParameterBagInterface;

interface ValueSourceFactoryInterface
{
    /**
     * Create a source.
     *
     * @param ParameterBagInterface $sourceParameters
     *
     * @return ValueSourceInterface
     */
    public function create(
        ParameterBagInterface $sourceParameters
    ): ValueSourceInterface;
}
