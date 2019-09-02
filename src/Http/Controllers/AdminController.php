<?php

namespace TypiCMS\Modules\Dashboard\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function index(): RedirectResponse
    {
        return redirect(route('dashboard'));
    }

    public function dashboard(Client $client): View
    {
        $welcomeMessage = config('typicms.welcome_message');
        $url = config('typicms.welcome_message_url');
        try {
            $response = $client->get($url);
            if ($response->getStatusCode() < 400) {
                $welcomeMessage = $response->getBody();
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }

        return view('dashboard::show')->with(compact('welcomeMessage'));
    }
}
