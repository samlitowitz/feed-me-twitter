<?php

namespace FeedMeTwitterOpenAPI\Media;

use FeedMe\Media;
use GuzzleHttp\Client;
use RuntimeException;
use Streamable\Stream;
use Streamable\String_;

final class Photo extends \OpenAPI\Client\Model\Photo implements Media
{
	/** @var ?string */
	private $cachedBinaryData;
	/** @var ?Client */
	private $client;

	public static function fromPhoto(\OpenAPI\Client\Model\Photo $photo): self
	{
		return new self($photo->jsonSerialize());
	}

	public function getBinaryData(): Stream
	{
		if ($this->cachedBinaryData === null) {
			$client = $this->getClient() ?? new Client();
			$this->cachedBinaryData = \file_get_contents($this->getUrl());
			if ($this->cachedBinaryData === false) {
				throw new RuntimeException(
					sprintf(
						'Unable to retrieve file contents for photo from %s',
						$this->getUrl()
					)
				);
			}
		}
		// TODO: Replace this with a resource stream, after it's implemented...
		return new String_($this->cachedBinaryData);
	}

	public function getCachedBinaryData(): ?string
	{
		return $this->cachedBinaryData;
	}

	public function setCachedBinaryData(?string $cachedBinaryData): void
	{
		$this->cachedBinaryData = $cachedBinaryData;
	}

	public function getClient(): ?Client
	{
		return $this->client;
	}

	public function setClient(?Client $client): void
	{
		$this->client = $client;
	}
}
