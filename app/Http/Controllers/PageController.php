<?php
/**
 * Created by IntelliJ IDEA.
 * User: vietpnk53
 * Date: 6/29/2017
 * Time: 1:26 PM
 */

namespace App\Http\Controllers;

use App\Repositories\Backend\PageRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /** @var  PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function content($alias)
    {
        $page = $this->pageRepository->findByField('alias', $alias);
        return view('page.content')->withPage($page);
    }
}