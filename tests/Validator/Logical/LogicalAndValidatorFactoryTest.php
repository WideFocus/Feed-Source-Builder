<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Validator\Logical;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Validator\Logical\LogicalAndValidatorFactory;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\Logical\LogicalAndValidator;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Validator\Logical\LogicalAndValidatorFactory
 */
class LogicalAndValidatorFactoryTest extends TestCase
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

        $factory = new LogicalAndValidatorFactory();
        $this->assertInstanceOf(
            LogicalAndValidator::class,
            $factory->create($constraints)
        );
    }
}
