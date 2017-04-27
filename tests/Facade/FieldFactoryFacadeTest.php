<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Facade;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Field\SourceFieldFactoryAggregateInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombination;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\Builder\Facade\FieldFactoryFacade;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Facade\FieldFactoryFacade
 */
class FieldFactoryFacadeTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            FieldFactoryFacade::class,
            new FieldFactoryFacade(
                $this->createMock(SourceFieldFactoryAggregateInterface::class)
            )
        );
    }

    /**
     * @return void
     *
     * @covers ::create
     */
    public function testCreate()
    {
        $sourceParameters = $this->createMock(ParameterBagInterface::class);

        $feedFields = [
            $this->createMock(FeedFieldInterface::class),
            $this->createMock(FeedFieldInterface::class)
        ];

        $fields = [
            $this->createMock(SourceFieldInterface::class),
            $this->createMock(SourceFieldInterface::class)
        ];

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getFields' => $feedFields,
                'getSourceParameters' => $sourceParameters
            ]
        );

        $fieldFactory = $this->createMock(
            SourceFieldFactoryAggregateInterface::class
        );

        foreach ($feedFields as $key => $feedField) {
            $fieldFactory
                ->expects($this->at($key))
                ->method('create')
                ->with($feedField, $sourceParameters)
                ->willReturn($fields[$key]);
        }

        $factory = new FieldFactoryFacade($fieldFactory);
        $this->assertInstanceOf(
            SourceFieldCombination::class,
            $factory->create($feed)
        );
    }
}
