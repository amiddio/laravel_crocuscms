<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertColor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageCreateRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Repositories\Admin\PageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{

    public function __construct(
        protected PageRepository $pageRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pages = $this->pageRepository->all();

        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($page = $this->pageRepository->create($validated)) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'Page \':name\' created successfully',
                    ['name' => $page->name]
                )
            );
        } else {
            self::setAlert(
                type: AlertColor::ERROR,
                message: __(
                    'An error has occurred creating admin. Please contact the administrator.'
                )
            );
        }

        return redirect()->route('admin.pages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $page = $this->pageRepository->find(id: $id);
        if (!$page) {
            abort(404);
        }

        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, string $id): RedirectResponse
    {
        $page = $this->pageRepository->find(id: $id);
        if (!$page) {
            abort(404);
        }

        $validated = $request->validated();

        $page = $this->pageRepository->update($page, $validated);
        if ($page->wasChanged()) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'The page \':page\' changed successfully',
                    ['page' => $page->name]
                )
            );
        }

        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $page = $this->pageRepository->find(id: $id);
        if (!$page) {
            abort(404);
        }

        if ($this->pageRepository->delete($page)) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'The page \':page\' deleted successfully',
                    ['page' => $page->name]
                )
            );
        } else {
            self::setAlert(
                type: AlertColor::ERROR,
                message: __(
                    'An error has occurred deleting admin. Please contact the administrator.'
                )
            );
        }

        return redirect()->route('admin.pages.index');
    }

}
