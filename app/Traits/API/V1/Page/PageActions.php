<?php

namespace App\Traits\API\V1\Page;

// load Custom Requests
use App\Http\Requests\API\V1\Page\PageRequest;

use App\Services\API\V1\Interfaces\Page\IPageService;

trait PageActions
{
	private $iPageService;

	public function __construct(IPageService  $iPageService)
	{
		$this->iPageService = $iPageService;
	}
	
	/**
	 * getPages
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function getPages(PageRequest $request)
	{
		return  $this->iPageService->getPages($request);
	}
}
