<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Manager;
use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Manages source parameters objects.
 */
interface SourceParametersManagerInterface
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