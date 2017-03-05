<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceFieldFactoryInterface;
use WideFocus\Feed\Source\Builder\SourceFieldBuilder;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\SourceFieldBuilder
 */
class SourceFieldBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceFieldBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceFieldBuilder
    {
        return new SourceFieldBuilder(
            $this->createMock(NamedSourceFieldFactoryInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildFields
     * @covers ::createField
     */
    public function testBuildFields()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        // Feed fields
        $fooFeedField = $this->createFeedFieldMock('foo_type', 'foo_code', 'Foo');
        $barFeedField = $this->createFeedFieldMock('bar_type', 'bar_code', 'Bar');

        // Feed
        $feed = $this->createMock(FeedInterface::class);
        $feed
            ->expects($this->once())
            ->method('getFields')
            ->willReturn([$fooFeedField, $barFeedField]);

        // Source fields
        $fooSourceField = $this->createSourceFieldMock('foo_code');
        $barSourceField = $this->createSourceFieldMock('bar_code');

        $combinationSourceField = $this->createMock(SourceFieldCombinationInterface::class);
        $combinationSourceField
            ->expects($this->exactly(2))
            ->method('addField')
            ->withConsecutive([$fooSourceField, 'Foo'], [$barSourceField, 'Bar']);

        // Factory
        $factory = $this->createMock(NamedSourceFieldFactoryInterface::class);
        $factory
            ->expects($this->at(0))
            ->method('createCombinationField')
            ->with($parameters)
            ->willReturn($combinationSourceField);
        $factory
            ->expects($this->at(1))
            ->method('createField')
            ->with('foo_type', $parameters)
            ->willReturn($fooSourceField);
        $factory
            ->expects($this->at(2))
            ->method('createField')
            ->with('bar_type', $parameters)
            ->willReturn($barSourceField);

        // Test
        $builder = new SourceFieldBuilder($factory);
        $this->assertSame($combinationSourceField, $builder->buildFields($feed, $parameters));
    }

    /**
     * @param string $type
     * @param string $code
     * @param string $name
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createFeedFieldMock(
        string $type,
        string $code,
        string $name
    ): PHPUnit_Framework_MockObject_MockObject {
        $field = $this->createMock(FeedFieldInterface::class);
        $field
            ->expects($this->once())
            ->method('getType')
            ->willReturn($type);
        $field
            ->expects($this->once())
            ->method('getName')
            ->willReturn($code);
        $field
            ->expects($this->once())
            ->method('getLabel')
            ->willReturn($name);

        return $field;
    }

    /**
     * @param string $code
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createSourceFieldMock(
        string $code
    ): PHPUnit_Framework_MockObject_MockObject {
        $field = $this->createMock(SourceFieldInterface::class);
        $field
            ->expects($this->once())
            ->method('setAttributeCode')
            ->with($code);
        return $field;
    }
}
