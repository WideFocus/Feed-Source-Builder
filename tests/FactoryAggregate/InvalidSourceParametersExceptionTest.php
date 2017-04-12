<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceParametersException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceParametersException
 */
class InvalidSourceParametersExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceParametersException
     * @expectedExceptionMessage A source parameters object with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidSourceParametersException::notRegistered('foo');
    }
}
