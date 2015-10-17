<?php

namespace TypiCMS\Modules\Dashboard\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Dashboard\Repositories\DashboardInterface;

class AdminController extends BaseAdminController
{
    public function __construct(DashboardInterface $dashboard)
    {
        parent::__construct($dashboard);
    }

    /**
     * Admin home.
     *
     * @return void
     */
    public function dashboard()
    {
        return view('dashboard::show')
            ->with('welcomeMessage', $this->repository->welcomeMessage());
    }

    /**
     * Redirect to dashboard.
     *
     * @return void
     */
    public function index()
    {
        return redirect(route('dashboard'));
    }
}
