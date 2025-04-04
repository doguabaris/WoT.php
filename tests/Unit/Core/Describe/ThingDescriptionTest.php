<?php

namespace WoT\Tests\Unit\Core\Describe;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use WoT\Core\Describe\ThingDescription;

/**
 * @covers \WoT\Core\Describe\ThingDescription
 */
class ThingDescriptionTest extends TestCase
{
    /**
     * Test if a ThingDescription object initializes with default values.
     */
    public function testInitializationWithDefaults(): void
    {
        $td = new ThingDescription();

        $this->assertSame(
            "https://www.w3.org/2019/wot/td/v1",
            $td->toArray()['@context']
        );

        $securityDefinitions = $td->toArray()['securityDefinitions'];
        $this->assertIsObject($securityDefinitions);
        $this->assertTrue(property_exists($securityDefinitions, 'nosec'));
        $this->assertIsObject($securityDefinitions->nosec);
        /** @var object $nosec */
        $nosec = $securityDefinitions->nosec;
        $this->assertObjectHasProperty('scheme', $nosec);
        /** @var string $scheme */
        $scheme = ((array)$nosec)['scheme'];
        $this->assertSame('nosec', $scheme);
        $this->assertSame([ "nosec" ], $td->toArray()['security']);
    }

    /**
     * Test setting the title of the Thing Description.
     */
    public function testSetTitle(): void
    {
        $td = new ThingDescription();
        $td->setTitle("My Device");

        $this->assertSame("My Device", $td->toArray()['title']);
    }

    /**
     * Test adding a property to the Thing Description.
     */
    public function testAddProperty(): void
    {
        $td = new ThingDescription();
        $td->addProperty("temperature", [
            "type" => "number",
            "forms" => [
                [
                    "href" => "/properties/temperature",
                    "op" => [ "readproperty" ],
                ],
            ],
        ]);

        /** @var array<string, mixed> $properties */
        $properties = $td->toArray()['properties'];

        $this->assertArrayHasKey('temperature', $properties);

        /** @var array<string, mixed> $temperature */
        $temperature = $properties['temperature'];

        $this->assertSame('number', $temperature['type']);
    }

    /**
     * Test adding a property without forms throws an exception.
     */
    public function testAddPropertyWithoutFormsThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Each property must have a 'forms' key.");

        $td = new ThingDescription();
        $td->addProperty("temperature", [
            "type" => "number",
        ]);
    }
}
