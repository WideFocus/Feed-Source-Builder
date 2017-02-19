<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Manager\IdentitySourceManagerInterface;
use WideFocus\Feed\Source\Builder\SourceConditionBuilderInterface;
use WideFocus\Feed\Source\Builder\SourceFieldBuilderInterface;
use WideFocus\Feed\Source\Builder\SourceIteratorBuilder;
use WideFocus\Feed\Source\Builder\SourceParametersBuilderInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactoryInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\SourceIteratorBuilder
 */
class SourceIteratorBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceIteratorBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceIteratorBuilder
    {
        return new SourceIteratorBuilder(
            $this->createMock(SourceIteratorFactoryInterface::class),
            $this->createMock(IdentitySourceManagerInterface::class),
            $this->createMock(SourceConditionBuilderInterface::class),
            $this->createMock(SourceFieldBuilderInterface::class),
            $this->createMock(SourceParametersBuilderInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildIterator
     */
    public function testBuildIterator()
    {
        $feed = $this->createMock(FeedInterface::class);

        $feed
            ->expects($this->once())
            ->method('getSourceType')
            ->willReturn('foo_source');

        $parameters        = $this->createMock(SourceParametersInterface::class);
        $parametersBuilder = $this->createMock(SourceParametersBuilderInterface::class);
        $parametersBuilder
            ->expects($this->once())
            ->method('buildParameters')
            ->with($feed)
            ->willReturn($parameters);

        $identitySource = $this->createMock(IdentitySourceInterface::class);

        $identitySourceManager = $this->createMock(IdentitySourceManagerInterface::class);
        $identitySourceManager
            ->expects($this->once())
            ->method('createSource')
            ->with('foo_source', $parameters)
            ->willReturn($identitySource);

        $conditions = $this->createMock(SourceConditionCombinationInterface::class);

        $conditionBuilder = $this->createMock(SourceConditionBuilderInterface::class);
        $conditionBuilder
            ->expects($this->once())
            ->method('buildConditions')
            ->with($feed, $parameters)
            ->willReturn($conditions);

        $fields = $this->createMock(SourceFieldCombinationInterface::class);

        $fieldBuilder = $this->createMock(SourceFieldBuilderInterface::class);
        $fieldBuilder
            ->expects($this->once())
            ->method('buildFields')
            ->with($feed, $parameters)
            ->willReturn($fields);

        $iterator = $this->createMock(SourceIteratorInterface::class);

        $iteratorFactory = $this->createMock(SourceIteratorFactoryInterface::class);
        $iteratorFactory
            ->expects($this->once())
            ->method('createIterator')
            ->with($identitySource, $conditions, $fields)
            ->willReturn($iterator);

        $builder = new SourceIteratorBuilder(
            $iteratorFactory,
            $identitySourceManager,
            $conditionBuilder,
            $fieldBuilder,
            $parametersBuilder
        );

        $builder->buildIterator($feed);
    }
}
