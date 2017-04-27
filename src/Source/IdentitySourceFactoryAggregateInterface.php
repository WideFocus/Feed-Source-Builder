<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Source;

use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates identity sources by name.
 */
interface IdentitySourceFactoryAggregateInterface
{
    /**
     * Create an identity source.
     *
     * @param string                $type
     * @param ParameterBagInterface $sourceParameters
     *
     * @return IdentitySourceInterface
     */
    public function create(
        string $type,
        ParameterBagInterface $sourceParameters
    ): IdentitySourceInterface;

    /**
     * Add a source factory.
     *
     * @param string                         $type
     * @param IdentitySourceFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(
        string $type,
        IdentitySourceFactoryInterface $factory
    );
}
