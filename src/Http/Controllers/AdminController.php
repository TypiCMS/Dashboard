<?php

namespace TypiCMS\Modules\Dashboard\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Dashboard\Repositories\DashboardInterface;

class AdminController extends BaseAdminController
{
    public function __construct(DashboardInterface $dashboard)
    {
        parent::__construct($dashboard);
        $this->middleware('admin', ['except' => 'index']);
    }

    /**
     * Redirect to dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect(route('dashboard'));
    }

    /**
     * Admin home.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard::show')
            ->with('welcomeMessage', $this->repository->welcomeMessage());
    }
}
