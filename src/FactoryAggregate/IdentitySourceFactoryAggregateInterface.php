<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\FactoryAggregate;

use WideFocus\Feed\Source\IdentitySourceFactoryInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates identity sources by name.
 */
interface IdentitySourceFactoryAggregateInterface
{
    /**
     * Create an identity source.
     *
     * @param string                    $name
     * @param SourceParametersInterface $parameters
     *
     * @return IdentitySourceInterface
     */
    public function createSource(
        string $name,
        SourceParametersInterface $parameters
    ): IdentitySourceInterface;

    /**
     * Add a source factory.
     *
     * @param IdentitySourceFactoryInterface $factory
     * @param string                         $name
     *
     * @return void
     */
    public function addSourceFactory(
        IdentitySourceFactoryInterface $factory,
        string $name
    );
}
