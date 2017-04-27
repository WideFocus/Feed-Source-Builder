<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Source;

use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates identity sources.
 */
interface IdentitySourceFactoryInterface
{
    /**
     * Create a source.
     *
     * @param ParameterBagInterface $sourceParameters
     *
     * @return IdentitySourceInterface
     */
    public function create(
        ParameterBagInterface $sourceParameters
    ): IdentitySourceInterface;
}
