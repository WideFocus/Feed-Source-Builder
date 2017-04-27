<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Condition;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Condition\InvalidSourceConditionException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Condition\InvalidSourceConditionException
 */
class InvalidSourceConditionExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Condition\InvalidSourceConditionException
     * @expectedExceptionMessage A source condition with name foo has not been registered
     *
     * @throws InvalidSourceConditionException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidSourceConditionException('foo');
    }
}
