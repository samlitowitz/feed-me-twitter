<?php

namespace FeedMeTwitterOpenAPI\Content;

use FeedMe\Content;
use FeedMe\Media\Collection;
use FeedMeTwitterOpenAPI\Media\Photo;
use FeedMeTwitterOpenAPI\Media\Text;
use FeedMeTwitterOpenAPI\Media\Video;
use OpenAPI\Client\Model\Expansions;
use OpenAPI\Client\Model\Media;

final class Tweet implements Content {
	/** @var Collection[] */
	private $collection;

	public function __construct()
	{
		$this->collection = new Collection();
	}

	public static function fromTweet(\OpenAPI\Client\Model\Tweet $tweet, ?Expansions $includes = null): self
	{
		$obj = new self();
		$collection = $obj->getMedia();

		$collection->add(new Text($tweet->getText()));

		if ($includes === null) {
			$obj->setMedia($collection);
			return $obj;
		}

		$mediaByKey = [];
		foreach ($includes->getMedia() as $media) {
			switch ($media->getType()) {
				case 'photo':
					$mediaByKey[$media->getMediaKey()] = Photo::fromPhoto($media);
					break;
				case 'video':
					$mediaByKey[$media->getMediaKey()] = Video::fromVideo($media);
					break;
				default:
			}
		}

		$attachments = $tweet->getAttachments();
		if ($attachments !== null) {
			$mediaKeys = $attachments->getMediaKeys() ?: [];
			foreach ($mediaKeys as $mediaKey) {
				if (!\array_key_exists($mediaKey, $mediaByKey)) {
					continue;
				}
				$collection->add($mediaKey[$mediaKey]);
			}
		}

		$obj->setMedia($collection);
		return $obj;
	}

	public function getMedia(): Collection
	{
		return $this->collection;
	}

	public function setMedia(Collection $collection): void
	{
		$this->collection = $collection;
	}
}
