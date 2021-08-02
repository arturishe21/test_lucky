<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSignature;
use App\Models\RemovedLink;
use App\Models\ResultOfLucky;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TemporaryPageController extends BaseController
{
    private $numberRandom;

    public function index(Request $request)
    {
        if (RemovedLink::whereSignature($request->get('signature'))->exists()) {
            abort(403, 'The link was removed');
        }

        return view('temporary_page');
    }

    public function generateNewLink(CheckSignature $request)
    {
        return URL::temporarySignedRoute(
            'temporary-url', now()->addDays(7), ['user' => $request->get('signature')]
        );
    }

    public function removeLink(CheckSignature $request)
    {
        RemovedLink::create([
            'signature' => $request->get('signature')
        ]);
    }

    public function feelingLucky(CheckSignature $request)
    {
        $this->numberRandom = random_int(0, 1000);

        $result = [
            'is_win' => $this->checkWin(),
            'total' => $this->getTotalWin(),
        ];

        ResultOfLucky::create(
            array_merge($result, [
                'signature' => $request->get('signature')
            ])
           );

        return  view('partials.feeling_lucky', compact('result'))->render();
    }

    public function getHistory(CheckSignature $request)
    {
        $result = ResultOfLucky::whereSignature($request->get('signature'))->latest()->limit(3)->get([
            'is_win',
            'total',
        ]);

        return view('partials.history', compact('result'))->render();
    }

    private function checkWin() : bool
    {
        return $this->numberRandom % 2 == 0;
    }

    private function getTotalWin() : int
    {
        $numberRandom = $this->numberRandom;

        if (!$this->checkWin($numberRandom)) {
            return 0;
        }

        if ($numberRandom > 900) {
            return round($numberRandom * 0.7);
        }

        if ($numberRandom > 600) {
            return round($numberRandom * 0.5);
        }

        if ($numberRandom > 300) {
            return round($numberRandom * 0.3);
        }

        return round($numberRandom * 0.1);
    }
}
