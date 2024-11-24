<?php

namespace WoT\Tests\Unit\Core\Generate;

use WoT\Core\Describe\ThingDescription;
use WoT\Core\Generate\Generator;
use WoT\Core\Parse\Parser;
use PHPUnit\Framework\TestCase;

/**
 * @covers \WoT\Core\Generate\Generator
 */
class GeneratorTest extends TestCase
{
    /**
     * Test generating JSON from a ThingDescription object.
     */
    public function testGenerateJson(): void
    {
        $td = new ThingDescription();
        $td->setTitle("My Device")->addProperty("temperature", [
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

        $generatedJson = Generator::generate($td);

        $this->assertJson($generatedJson);

        $parsedData = Parser::parse($generatedJson);

        $this->assertSame("My Device", $parsedData['title']);
        $this->assertArrayHasKey("properties", $parsedData);
        $this->assertArrayHasKey("temperature", $parsedData['properties']);
        $this->assertSame("number", $parsedData['properties']['temperature']['type']);
    }
}
