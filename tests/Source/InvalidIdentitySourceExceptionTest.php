<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Source;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Source\InvalidIdentitySourceException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Source\InvalidIdentitySourceException
 */
class InvalidIdentitySourceExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Source\InvalidIdentitySourceException
     * @expectedExceptionMessage An identity source with name foo has not been registered
     *
     * @throws InvalidIdentitySourceException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidIdentitySourceException('foo');
    }
}
