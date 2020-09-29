<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Support\Collection;
use App\Http\Resources\API\V1\Interfaces\IHandler;

class Handler implements IHandler
{
	public function __construct()
	{
	}

	/**
	 * Transforms the classes having transform method
	 *
	 * @param $content
	 * @return array
	 */
	public function transformModel($content)
	{
		if (is_array($content) || $content instanceof Collection) {
			return $this->transformObjects($content);
		} elseif (is_object($content) && $this->isTransformable($content)) {
			return $content->setResource($content);
		}
	}

	private function transformObjects($toTransform)
	{
		$transformed = [];
		foreach ($toTransform as $key => $item) {
			$transformed[$key] = $this->isTransformable($item) ? $item->setResource($item) : $item;
		}

		return $transformed;
	}

	private function isTransformable($item)
	{
		return is_object($item) && method_exists($item, 'setResource');
	}
}
