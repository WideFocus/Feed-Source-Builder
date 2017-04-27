<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Field;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Source\Builder\Field\SourceFieldFactory;
use WideFocus\Feed\Source\Builder\Source\ValueSourceFactoryInterface;
use WideFocus\Feed\Source\Field\SourceField;
use WideFocus\Feed\Source\ValueSourceInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Field\SourceFieldFactory
 */
class SourceFieldFactoryTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceFieldFactory::class,
            new SourceFieldFactory(
                $this->createMock(ValueSourceFactoryInterface::class)
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
        $parameters = $this->createMock(ParameterBagInterface::class);
        $source     = $this->createMock(ValueSourceInterface::class);

        $feedField = $this->createMock(FeedFieldInterface::class);
        $feedField
            ->expects($this->once())
            ->method('getName')
            ->willReturn('foo');

        $sourceFactory = $this->createMock(ValueSourceFactoryInterface::class);
        $sourceFactory
            ->expects($this->once())
            ->method('create')
            ->with($parameters)
            ->willReturn($source);

        $factory = new SourceFieldFactory($sourceFactory);
        $this->assertInstanceOf(
            SourceField::class,
            $factory->create($feedField, $parameters)
        );
    }
}
