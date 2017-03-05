<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\NamedFactory;

use WideFocus\Feed\Source\IdentitySourceFactoryInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates identity sources by name.
 */
class NamedIdentitySourceFactory implements NamedIdentitySourceFactoryInterface
{
    /**
     * @var IdentitySourceFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create an identity source.
     *
     * @param string                    $name
     * @param SourceParametersInterface $parameters
     *
     * @return IdentitySourceInterface
     *
     * @throws InvalidIdentitySourceException When a requested identity source
     *   does not exist.
     */
    public function createSource(
        string $name,
        SourceParametersInterface $parameters
    ): IdentitySourceInterface {
        if (!array_key_exists($name, $this->factories)) {
            throw InvalidIdentitySourceException::notRegistered($name);
        }
        return $this->factories[$name]
            ->createSource($parameters);
    }

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
    ) {
        $this->factories[$name] = $factory;
    }
}
