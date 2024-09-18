<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PageController extends Controller
{

    /**
     * @param Request $request
     * @param PageRepository $pageRepository
     * @return View
     */
    public function __invoke(Request $request, PageRepository $pageRepository): View
    {
        $lang = app()->getLocale();
        if ($lang == config('app.defaultLocale')) {
            $pageName = $request->segment(1);
        } else {
            $pageName = $request->segment(2);
        }

        $page = Cache::remember($pageName.'.'.$lang, now()->addDays(1), function () use ($pageRepository, $pageName, $lang) {
            $res = $pageRepository->getPageByName(pageName: $pageName, lang: $lang);
            if (!$res) {
                abort(404);
            }
            return $res;
        });

        return view('page.index', compact('page'));
    }

}
