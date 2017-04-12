<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidIdentitySourceException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidIdentitySourceException
 */
class InvalidIdentitySourceExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidIdentitySourceException
     * @expectedExceptionMessage An identity source with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidIdentitySourceException::notRegistered('foo');
    }
}
