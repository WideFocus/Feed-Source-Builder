<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\InvalidSourceParametersException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\InvalidSourceParametersException
 */
class InvalidSourceParametersExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidSourceParametersException
     * @expectedExceptionMessage A source parameters object with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceParametersException::notRegistered('foo');
    }
}
