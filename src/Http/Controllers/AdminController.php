<?php
namespace TypiCMS\Modules\Dashboard\Http\Controllers;

use View;
use TypiCMS\Modules\Dashboard\Http\Requests\FormRequest;
use TypiCMS\Modules\Dashboard\Repositories\DashboardInterface;
use TypiCMS\Http\Controllers\AdminSimpleController;

class AdminController extends AdminSimpleController
{

    public function __construct(DashboardInterface $dashboard)
    {
        parent::__construct($dashboard);
        $this->title['parent'] = trans('dashboard::global.Dashboard');
    }

    /**
     * Admin home
     *
     * @return void
     */
    public function index()
    {
        return view('dashboard::show')
            ->with('welcomeMessage', $this->repository->getWelcomeMessage());
    }
}
