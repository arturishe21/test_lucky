<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateUrlForm;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class GenerateUrlController extends BaseController
{
    public function __invoke(GenerateUrlForm $request)
    {
        $url = URL::temporarySignedRoute(
            'temporary-url', now()->addDays(7), ['user' => $request->get('username')]
        );

        return back()->with('temporary-url', $url);
    }
}
