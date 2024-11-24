<?php

namespace WoT\Tests\Unit\Core\Validate;

use WoT\Core\Describe\ThingDescription;
use WoT\Core\Validate\Validator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \WoT\Core\Validate\Validator
 */
class ValidatorTest extends TestCase
{
    /**
     * Test validation of a valid Thing Description against a JSON Schema.
     */
    public function testValidateValidThingDescription(): void
    {
        $td = new ThingDescription();
        $td->setTitle("Valid Device")->addProperty("temperature", [
                "type" => "number",
                "forms" => [
                    [
                        "href" => "/properties/temperature",
                        "op" => [ "readproperty" ],
                    ],
                ],
            ])->addProperty("status", [
                "type" => "boolean",
                "forms" => [
                    [
                        "href" => "/properties/status",
                        "op" => [ "readproperty" ],
                    ],
                ],
            ]);

        Validator::validate($td);
        $this->assertSame(
            "Valid Device",
            $td->toArray()["title"],
            "The Thing Description title should match."
        );
    }

    /**
     * Test validation of an invalid Thing Description against a JSON Schema.
     */
    public function testValidateInvalidThingDescription(): void
    {
        $td = new ThingDescription();
        $td->setTitle("Invalid Device");

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Validation failed");

        Validator::validate(new ThingDescription());
    }
}
