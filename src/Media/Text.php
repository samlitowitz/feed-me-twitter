<?php

namespace FeedMeTwitterOpenAPI\Media;

use FeedMe\Media;

final class Text implements Media {
	/** @var ?string */
	private $text;

	public function __construct(?string $text = null)
	{
		$this->setText($text);
	}

	public function getBinaryData(): string
	{
		return $this->getText() ?: '';
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
