<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\InvalidSourceConditionException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\InvalidSourceConditionException
 */
class InvalidSourceConditionExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidSourceConditionException
     * @expectedExceptionMessage A source condition with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceConditionException::notRegistered('foo');
    }
}
