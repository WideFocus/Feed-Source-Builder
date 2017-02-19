<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\InvalidSourceFieldException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\InvalidSourceFieldException
 */
class InvalidSourceFieldExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidSourceFieldException
     * @expectedExceptionMessage A source field with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceFieldException::notRegistered('foo');
    }
}
