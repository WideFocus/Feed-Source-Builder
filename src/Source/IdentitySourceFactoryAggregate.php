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
class IdentitySourceFactoryAggregate implements IdentitySourceFactoryAggregateInterface
{
    /**
     * @var IdentitySourceFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create an identity source.
     *
     * @param string                $type
     * @param ParameterBagInterface $sourceParameters
     *
     * @return IdentitySourceInterface
     *
     * @throws InvalidIdentitySourceException When a requested identity source
     *   does not exist.
     */
    public function create(
        string $type,
        ParameterBagInterface $sourceParameters
    ): IdentitySourceInterface {
        if (!array_key_exists($type, $this->factories)) {
            throw new InvalidIdentitySourceException($type);
        }

        return $this->factories[$type]
            ->create($sourceParameters);
    }

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
    ) {
        $this->factories[$type] = $factory;
    }
}
