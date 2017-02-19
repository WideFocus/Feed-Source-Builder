<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Manager;

use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Manages source fields.
 */
interface SourceFieldManagerInterface
{
    const COMBINATION_NAME = 'combination';

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
    ): SourceFieldInterface;

    /**
     * Create a combination field.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return SourceFieldCombinationInterface
     */
    public function createCombinationField(
        SourceParametersInterface $parameters
    ): SourceFieldCombinationInterface;

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
    );
}
