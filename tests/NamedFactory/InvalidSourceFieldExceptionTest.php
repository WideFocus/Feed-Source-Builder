<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceFieldException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceFieldException
 */
class InvalidSourceFieldExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceFieldException
     * @expectedExceptionMessage A source field with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceFieldException::notRegistered('foo');
    }
}
