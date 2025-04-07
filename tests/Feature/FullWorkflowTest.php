<?php

namespace WoT\Tests\Feature;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use WoT\Core\Describe\ThingDescription;
use WoT\Core\Generate\Generator;
use WoT\Core\Parse\Parser;
use WoT\Core\Validate\Validator;

/**
 * @coversNothing
 */
class FullWorkflowTest extends TestCase
{
    /**
     * Test the full workflow of generating, parsing, and validating a Thing Description.
     */
    public function testFullWorkflow(): void
    {
        // Create a Thing Description object
        $td = new ThingDescription();
        $td->setTitle("Smart Thermostat")->addProperty("temperature", [
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

        $tdArray = $td->toArray();
        $this->assertArrayHasKey("title", $tdArray);
        $this->assertSame("Smart Thermostat", $tdArray["title"]);
        $this->assertArrayHasKey("properties", $tdArray);
        /** @var array<string, mixed> $properties */
        $properties = $tdArray["properties"];
        $this->assertCount(2, $properties);

        // Generate JSON from the Thing Description
        $generatedJson = Generator::generate($td);
        $this->assertJson($generatedJson);

        // Parse the generated JSON back to an array
        $parsedData = Parser::parse($generatedJson);
        /** @var array{title: string, properties: array<string, array<string, mixed>>} $parsedData */
        $this->assertArrayHasKey("title", $parsedData);
        $this->assertSame("Smart Thermostat", $parsedData['title']);
        $this->assertArrayHasKey("properties", $parsedData);
        $this->assertCount(2, $parsedData["properties"]);
        $this->assertArrayHasKey("temperature", $parsedData["properties"]);
        $this->assertArrayHasKey("status", $parsedData["properties"]);

        // Validate the parsed Thing Description
        $thingDescription = new ThingDescription();
        $thingDescription->setTitle($parsedData['title'])->addProperty(
            'temperature',
            $parsedData['properties']['temperature']
        )->addProperty('status', $parsedData['properties']['status']);

        try {
            Validator::validate($thingDescription);
            $this->assertSame(
                "Smart Thermostat",
                $thingDescription->toArray()["title"],
                "The Thing Description title should match after validation."
            );
            $this->assertArrayHasKey("properties", $thingDescription->toArray());
            /** @var array<string, mixed> $properties */
            $properties = $thingDescription->toArray()["properties"];
            $this->assertCount(2, $properties);
        } catch (InvalidArgumentException $e) {
            $this->fail("Validation failed: " . $e->getMessage());
        }
    }
}
