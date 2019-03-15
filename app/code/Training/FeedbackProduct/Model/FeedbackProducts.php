<?php

namespace Training\FeedbackProduct\Model;

use Training\Feedback\Model\Feedback;
use Training\FeedbackProduct\Model\ResourceModel\FeedbackProducts as FeedbackResource;

class FeedbackProducts
{
	private $feedbackDataLoader;
	private $feedbackProductsResource;

	public function __construct(
		FeedbackDataLoader $feedbackDataLoader,
		FeedbackResource $feedbackProductsResource
	) {
		$this->feedbackDataLoader = $feedbackDataLoader;
		$this->feedbackProductsResource = $feedbackProductsResource;
	}

	public function loadProductRelations($feedback)
	{
		$productIds = $this->feedbackProductsResource->loadProductRelations($feedback->getId());
		return $this->feedbackDataLoader->addProductsToFeedbackByIds($feedback, $productIds);
	}

	/**
	 * @param Feedback $feedback
	 * @return $this
	 */
	public function saveProductRelations($feedback)
	{
		$productIds = [];
		$products = $feedback->getExtensionAttributes()->getProducts();
		if (is_array($products)) {
			foreach ($products as $product) {
				$productIds[] = $product->getId();
			}
		}
		$this->feedbackProductsResource->saveProductRelations($feedback->getId(), $productIds);
		return $this;
	}
}