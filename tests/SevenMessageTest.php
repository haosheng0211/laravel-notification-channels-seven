<?php

namespace NotificationChannels\Seven\Test;

use NotificationChannels\Seven\SevenMessage;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class SevenMessageTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $message = new SevenMessage('Hello World');
        $this->assertEquals('Hello World', $message->content);
    }

    public function testCanBeInstantiatedWithCreateMethod()
    {
        $message = SevenMessage::create('Hello World');
        $this->assertInstanceOf(SevenMessage::class, $message);
        $this->assertEquals('Hello World', $message->content);
    }

    public function testContentCanBeSet()
    {
        $message = new SevenMessage();
        $message->content('New Content');
        $this->assertEquals('New Content', $message->content);
    }
}
