<?php

namespace TypiCMS\Modules\Dashboard\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('see dashboard')) {
            return;
        }
        $view->sidebar->group('dashboard', function (SidebarGroup $group) {
            $group->id = 'dashboard';
            $group->weight = 10;
            $group->hideHeading();
            $group->addItem(__('Dashboard'), function (SidebarItem $item) {
                $item->id = 'dashboard';
                $item->icon = config('typicms.dashboard.sidebar.icon');
                $item->weight = config('typicms.dashboard.sidebar.weight');
                $item->route('admin::dashboard');
            });
        });
    }
}
