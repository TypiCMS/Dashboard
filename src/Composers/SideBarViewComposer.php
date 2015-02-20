<?php
namespace TypiCMS\Modules\Dashboard\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group('dashboard', function (SidebarGroup $group) {
            $group->id = 'dashboard';
            $group->weight = 10;
            $group->hideHeading();
            $group->addItem(trans('dashboard::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.dashboard.sidebar.icon', 'icon fa fa-fw fa-dashboard');
                $item->weight = config('typicms.dashboard.sidebar.weight');
                $item->route('dashboard');
                $item->authorize(
                    $this->auth->hasAccess('dashboard.index')
                );
            });
        });
    }
}
