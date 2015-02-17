<?php
namespace TypiCMS\Modules\Dashboard\Repositories;

use GuzzleHttp\Client;
use TypiCMS\Repositories\RepositoriesAbstract;

class EloquentDashboard extends RepositoriesAbstract implements DashboardInterface
{

    public function welcomeMessage()
    {
        if ($welcomeMessageUrl = config('typicms.welcome_message_url')) {
            $response = with(new Client)->get($welcomeMessageUrl);
            if ($response->getStatusCode() < 400) {
                return $response->getBody();
            }
        }

        return config('typicms.welcome_message');
    }
}
