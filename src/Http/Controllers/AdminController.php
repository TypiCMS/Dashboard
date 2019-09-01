<?php

namespace TypiCMS\Modules\Dashboard\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
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
            ->with('welcomeMessage', $this->model->welcomeMessage());
    }
}
