<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\FactoryAggregate;

use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates source parameters objects by name
 */
interface SourceParametersFactoryAggregateInterface
{
    /**
     * Create parameters.
     *
     * @param string $name
     * @param array  $data
     *
     * @return SourceParametersInterface
     *
     * @throws InvalidSourceParametersException When the requested parameters
     * object does not have a factory.
     */
    public function createParameters(
        string $name,
        array $data = []
    ): SourceParametersInterface;

    /**
     * Add a parameters factory.
     *
     * @param SourceParametersFactoryInterface $factory
     * @param string                           $name
     *
     * @return void
     */
    public function addParametersFactory(
        SourceParametersFactoryInterface $factory,
        string $name
    );
}
