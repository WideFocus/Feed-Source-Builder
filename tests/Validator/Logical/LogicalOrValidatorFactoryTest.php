<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Validator\Logical;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Validator\Logical\LogicalOrValidatorFactory;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\Logical\LogicalOrValidator;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Validator\Logical\LogicalOrValidatorFactory
 */
class LogicalOrValidatorFactoryTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::create
     */
    public function testCreate()
    {
        $constraints = $this->createMock(ParameterBagInterface::class);
        $constraints
            ->expects($this->once())
            ->method('get')
            ->with('value')
            ->willReturn(true);

        $factory = new LogicalOrValidatorFactory();
        $this->assertInstanceOf(
            LogicalOrValidator::class,
            $factory->create($constraints)
        );
    }
}
