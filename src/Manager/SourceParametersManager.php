<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Manager;
use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;


/**
 * Manages source parameters objects.
 */
class SourceParametersManager implements SourceParametersManagerInterface
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