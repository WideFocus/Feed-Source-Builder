<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\Condition\FeedConditionInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Manager\SourceConditionManagerInterface;
use WideFocus\Feed\Source\Builder\SourceConditionBuilder;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\SourceConditionBuilder
 */
class SourceConditionBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceConditionBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceConditionBuilder
    {
        return new SourceConditionBuilder(
            $this->createMock(SourceConditionManagerInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildConditions
     * @covers ::createCondition
     * @covers ::addConditionsToCombination
     */
    public function testBuildConditions()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        // Feed conditions
        $fooFeedCondition      = $this->createFeedConditionMock('foo_type', 'foo_code', 'foo_value', 'eq');
        $barFeedConditionChild = $this->createFeedConditionMock('baz_type', 'baz_code', 'baz_value', 'eq');
        $barFeedCondition      = $this->createFeedConditionMock(
            'bar_type',
            'bar_code',
            'bar_value',
            'and',
            [$barFeedConditionChild]
        );

        // Feed
        $feed = $this->createMock(FeedInterface::class);
        $feed
            ->expects($this->once())
            ->method('getConditions')
            ->willReturn([$fooFeedCondition, $barFeedCondition]);

        // Source conditions
        $fooSourceCondition      = $this->createSourceConditionMock('foo_code', 'foo_value', 'eq');
        $barSourceConditionChild = $this->createSourceConditionMock('baz_code', 'baz_value', 'eq');
        $barSourceCondition      = $this->createSourceConditionMock(
            'bar_code',
            'bar_value',
            'and',
            [$barFeedConditionChild]
        );


        $combinationSourceCondition = $this->createMock(SourceConditionCombinationInterface::class);
        $combinationSourceCondition
            ->expects($this->exactly(2))
            ->method('addCondition')
            ->withConsecutive($fooSourceCondition, $barSourceCondition);

        // Manager
        $manager = $this->createMock(SourceConditionManagerInterface::class);
        $manager
            ->expects($this->at(0))
            ->method('createCombinationCondition')
            ->with($parameters)
            ->willReturn($combinationSourceCondition);
        $manager
            ->expects($this->at(1))
            ->method('createCondition')
            ->with('foo_type', $parameters)
            ->willReturn($fooSourceCondition);
        $manager
            ->expects($this->at(2))
            ->method('createCondition')
            ->with('bar_type', $parameters)
            ->willReturn($barSourceCondition);
        $manager
            ->expects($this->at(3))
            ->method('createCondition')
            ->with('baz_type', $parameters)
            ->willReturn($barSourceConditionChild);

        // Test
        $builder = new SourceConditionBuilder($manager);
        $this->assertSame($combinationSourceCondition, $builder->buildConditions($feed, $parameters));
    }

    /**
     * @param string $type
     * @param string $code
     * @param string $operator
     * @param string $value
     * @param array  $children
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function createFeedConditionMock(
        string $type,
        string $code,
        string $operator,
        string $value,
        array $children = []
    ) {
        $condition = $this->createMock(FeedConditionInterface::class);
        $condition
            ->expects($this->once())
            ->method('getType')
            ->willReturn($type);
        $condition
            ->expects($this->once())
            ->method('getName')
            ->willReturn($code);
        $condition
            ->expects($this->once())
            ->method('getValue')
            ->willReturn($value);
        $condition
            ->expects($this->once())
            ->method('getOperator')
            ->willReturn($operator);

        if (count($children)) {
            $condition
                ->expects($this->once())
                ->method('getChildren')
                ->willReturn($children);
        }
        return $condition;
    }

    /**
     * @param string $code
     * @param string $operator
     * @param string $value
     * @param array  $children
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function createSourceConditionMock(
        string $code,
        string $operator,
        string $value,
        array $children = []
    ) {
        $condition = count($children)
            ? $this->createMock(SourceConditionCombinationInterface::class)
            : $this->createMock(SourceConditionInterface::class);

        $condition
            ->expects($this->once())
            ->method('setAttributeCode')
            ->with($code);
        $condition
            ->expects($this->once())
            ->method('setValue')
            ->with($value);
        $condition
            ->expects($this->once())
            ->method('setOperator')
            ->with($operator);

        foreach ($children as $index => $child) {
            $condition
                ->expects($this->exactly(count($children)))
                ->method('addCondition')
                ->withConsecutive(...$children);
        }
        return $condition;
    }
}
