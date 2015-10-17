<?php

namespace TypiCMS\Modules\Dashboard\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentDashboard extends RepositoriesAbstract implements DashboardInterface
{
    public function welcomeMessage()
    {
        if ($welcomeMessageUrl = config('typicms.welcome_message_url')) {
            $ch = curl_init($welcomeMessageUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $welcomeMessage = curl_exec($ch);
            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) < 400) {
                curl_close($ch);

                return $welcomeMessage;
            }
        }

        return config('typicms.welcome_message');
    }
}
