<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Manager;

use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Manages source fields.
 */
class SourceFieldManager implements SourceFieldManagerInterface
{
    /**
     * @var SourceFieldFactoryInterface[]
     */
    private $factories = [];

    /**
     * Constructor.
     *
     * @param SourceFieldFactoryInterface $combinationFactory
     */
    public function __construct(
        SourceFieldFactoryInterface $combinationFactory
    ) {
        $this->addFieldFactory($combinationFactory, self::COMBINATION_NAME);
    }

    /**
     * Create a field.
     *
     * @param string                    $name
     * @param SourceParametersInterface $parameters
     *
     * @return SourceFieldInterface
     */
    public function createField(
        string $name,
        SourceParametersInterface $parameters
    ): SourceFieldInterface {
        if (!array_key_exists($name, $this->factories)) {
            throw InvalidSourceFieldException::notRegistered($name);
        }
        return $this->factories[$name]
            ->createField($parameters);
    }

    /**
     * Create a combination field.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return SourceFieldCombinationInterface
     */
    public function createCombinationField(
        SourceParametersInterface $parameters
    ): SourceFieldCombinationInterface {
        /** @var SourceFieldCombinationInterface $field */
        $field = $this->createField(self::COMBINATION_NAME, $parameters);
        return $field;
    }

    /**
     * Add a field factory.
     *
     * @param SourceFieldFactoryInterface $factory
     * @param string                      $name
     *
     * @return void
     */
    public function addFieldFactory(
        SourceFieldFactoryInterface $factory,
        string $name
    ) {
        $this->factories[$name] = $factory;
    }
}
