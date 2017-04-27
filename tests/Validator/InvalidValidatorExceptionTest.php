<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Validator;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Validator\InvalidValidatorException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Validator\InvalidValidatorException
 */
class InvalidValidatorExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Validator\InvalidValidatorException
     * @expectedExceptionMessage A validator for operator foo has not been registered
     *
     * @throws InvalidValidatorException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidValidatorException('foo');
    }
}
