<?php

namespace FeedMeTwitterOpenAPI\Media;

use FeedMe\Media;

final class Photo extends \OpenAPI\Client\Model\Photo implements Media
{
	public static function fromPhoto(\OpenAPI\Client\Model\Photo $photo): self
	{
		return new self($photo->jsonSerialize());
	}
	public function getBinaryData(): string
	{
		// TODO: Implement getBinaryData() method.
	}
}
