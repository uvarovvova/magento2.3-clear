<?php

namespace Training\Feedback\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface FeedbackSearchResultsInterface
 * @package Training\Feedback\Api\Data
 */
interface FeedbackSearchResultsInterface extends SearchResultsInterface
{
	/**
	 * Get Feedback list.
	 *
	 * @return \Training\Feedback\Api\Data\FeedbackInterface[]
	 */
	public function getItems();

	/**
	 * Set Feedback list.
	 *
	 * @param \Training\Feedback\Api\Data\FeedbackInterface[] $items
	 * @return $this
	 */
	public function setItems(array $items);
}