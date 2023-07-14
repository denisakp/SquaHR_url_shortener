<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Statistic;
use Inertia\Inertia;
use Inertia\Response;

class StatController extends Controller
{
    public function __invoke(ShortLink $shortLink): Response
    {
        return Inertia::render('LinkStats', [
            'link' => $shortLink,
            'stats' => $shortLink->statistics,
            'unique_view' => Statistic::where('short_link_id', $shortLink->id)->distinct('visitor')->count('visitor'),
            'rank' => Statistic::getRank($shortLink->id)
        ]);
    }
}
