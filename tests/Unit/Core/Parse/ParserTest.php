<?php

namespace WoT\Tests\Unit\Core\Parse;

use WoT\Core\Parse\Parser;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \WoT\Core\Parse\Parser
 */
class ParserTest extends TestCase
{
    /**
     * @covers \WoT\Core\Parse\Parser::parse
     */
    public function testParseValidJSON(): void
    {
        $json = '{"title": "Test Device", "@context": "https://w3.org/td", "properties": {}}';
        $data = Parser::parse($json);

        $this->assertEquals("Test Device", $data['title']);
        $this->assertArrayHasKey("@context", $data);
        $this->assertArrayHasKey("properties", $data);
    }

    /**
     * @covers \WoT\Core\Parse\Parser::parse
     */
    public function testParseInvalidJSON(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $invalidJson = '{"title": "Test Device", "@context": "https://w3.org/td", "properties": {';
        Parser::parse($invalidJson);
    }
}
