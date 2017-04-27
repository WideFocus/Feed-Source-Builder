<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Field;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Field\InvalidSourceFieldException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Field\InvalidSourceFieldException
 */
class InvalidSourceFieldExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Field\InvalidSourceFieldException
     * @expectedExceptionMessage A source field with name foo has not been registered
     *
     * @throws InvalidSourceFieldException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidSourceFieldException('foo');
    }
}
