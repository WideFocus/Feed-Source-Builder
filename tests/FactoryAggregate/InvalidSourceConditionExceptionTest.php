<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceConditionException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceConditionException
 */
class InvalidSourceConditionExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceConditionException
     * @expectedExceptionMessage A source condition with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceConditionException::notRegistered('foo');
    }
}
