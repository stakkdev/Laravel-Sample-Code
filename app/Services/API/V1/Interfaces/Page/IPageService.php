<?php

namespace App\Services\API\V1\Interfaces\Page;

// load Custom Requests
use App\Http\Requests\API\V1\Page\PageRequest;

interface IPageService
{
	public function getPages(PageRequest $request);
}
