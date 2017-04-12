<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\FactoryAggregate;

use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates source parameters objects by name.
 */
class SourceParametersFactoryAggregate implements SourceParametersFactoryAggregateInterface
{
    /**
     * @var SourceParametersFactoryInterface[]
     */
    private $factories = [];

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
    ): SourceParametersInterface {
        if (!array_key_exists($name, $this->factories)) {
            throw InvalidSourceParametersException::notRegistered($name);
        }

        return $this->factories[$name]
            ->createParameters($data);
    }

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
    ) {
        $this->factories[$name] = $factory;
    }
}
