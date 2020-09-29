<?php

namespace App\Services\API\V1\Page;

use App\Exceptions\API\V1\RecordNotFoundException;

use App\Traits\API\V1\Common\APIResponse;
use App\Http\Requests\API\V1\Page\PageRequest;
use App\Http\Resources\API\V1\Page\PageResource;
use App\Services\API\V1\Interfaces\Page\IPageService;
use App\Repositories\API\V1\Interfaces\Page\IPageRepository;

class PageService implements IPageService
{
	use APIResponse;

	private $iPageRepository;

	public function __construct(IPageRepository $iPageRepository)
	{
		$this->iPageRepository = $iPageRepository;
	}
		
	/**
	 * getPages
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function getPages(PageRequest $request){
		$page = $this->iPageRepository->get_page($request);
		
		if (!$page)
			throw new RecordNotFoundException(trans('api/page.page_not_found'));

		return $page;	
	}
}
