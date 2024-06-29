<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Gambler;
use App\Models\Game;
use App\Models\Link;
use Carbon\Carbon;


class TaskController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();

        $gambler = Gambler::firstOrCreate($input);
        $link = Link::createLink($gambler->id);

        return redirect("/link/{$link->slug}/{$gambler->id}");
    }

    public function show(Link $link, Gambler $gambler)
    {
        $expires_at = Carbon::parse($link->expires_at);

        if ($expires_at < Carbon::now()) {
            throw new \Exception('Link expired');
        }

        if (!$link->active) {
            throw new \Exception('Link is inactive');
        }

        return view('show', compact('link', 'gambler'));
    }

    public function generate($gamblerId)
    {
        $link = Link::createLink($gamblerId);
        return response()->json($link->toArray());
    }

    public function deactivate($slug)
    {
        $link = Link::where('slug', $slug)->first();
        $link->active = false;
        $link->save();

        return response()->json(['message' => 'Link has been deactivated']);
    }

    public function game($gamblerId)
    {
        $result = Game::play($gamblerId);
        Game::create($result);

        return response()->json($result);
    }

    public function history($gamblerId)
    {
        $games = Game::where('gambler_id', $gamblerId)->orderBy('created_at', 'desc')->limit(3)->get();

        return response()->json($games->toArray());
    }
}
