<?php

namespace NotificationChannels\Seven;

class SevenMessage
{
    public $content;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    public static function create(string $content = ''): SevenMessage
    {
        return new static($content);
    }

    public function content(string $content): SevenMessage
    {
        $this->content = $content;

        return $this;
    }
}
