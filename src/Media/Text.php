<?php

namespace FeedMeTwitterOpenAPI\Media;

use FeedMe\Media;
use Streamable\Stream;
use Streamable\String_;

final class Text implements Media {
	/** @var ?string */
	private $text;

	public function __construct(?string $text = null)
	{
		$this->setText($text);
	}

	public function getData(): Stream
	{
		return new String_($this->getText() ?: '');
	}

	public function getText(): ?string
	{
		return $this->text;
	}

	public function setText(?string $text): void
	{
		$this->text = $text;
	}
}
