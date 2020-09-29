<?php

namespace App\Repositories\API\V1\Page;

use App\Repositories\API\V1\Common\GenericRepository;
use App\Repositories\API\V1\Interfaces\Page\IPageRepository;

class PageRepository extends GenericRepository implements IPageRepository
{
	public function model()
	{
		return 'App\Models\Page';
    }
    
	public function get_page($request)
	{
		return $this->model->where('version', $request->version)->where('type', $request->page_type)->latest()->first();
	}
}
