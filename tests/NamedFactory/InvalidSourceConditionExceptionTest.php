<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceConditionException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceConditionException
 */
class InvalidSourceConditionExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceConditionException
     * @expectedExceptionMessage A source condition with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceConditionException::notRegistered('foo');
    }
}
