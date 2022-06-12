<?php

namespace FeedMeTwitterOpenAPI\Media;

use FeedMe\Media;

final class Video extends \OpenAPI\Client\Model\Video implements Media {
	public static function fromVideo(\OpenAPI\Client\Model\Video $video): self
	{
		return new self($video->jsonSerialize());
	}

	public function getBinaryData(): string
	{
		// TODO: Implement getBinaryData() method.
	}
}
