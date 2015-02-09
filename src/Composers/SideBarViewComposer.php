<?php
namespace TypiCMS\Modules\Dashboard\Composers;

use Illuminate\View\View;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->menus[0]->put('dashboard', [
            'weight' => config('typicms.dashboard.sidebar.weight'),
            'request' => $view->prefix,
            'route' => 'dashboard',
            'icon-class' => 'icon fa fa-fw fa-dashboard',
            'title' => 'Dashboard',
        ]);
    }
}
