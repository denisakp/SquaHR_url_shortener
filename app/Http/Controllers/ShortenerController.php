<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortenerRequest;
use App\Models\ShortLink;
use App\Models\Statistic;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ShortenerController extends Controller
{
    /**
     * Render shortener page
     * @return Response
     */
    public function index(): Response
    {
        $most_clicked = ShortLink::find(Statistic::getMostClickedUrl());
        return Inertia::render(
            'Welcome',
            [
                'data' => ShortLink::withCount('statistics')->latest()->get(),
                'unique_visitors' => Statistic::distinct('visitor')->count('visitor'),
                'most_clicked' => config('app.url') . '/' . $most_clicked->code
            ]
        );
    }


    /**
     * @param Request $request
     * @param string $code
     * @return RedirectResponse|void
     */
    public function show(Request $request, string $code)
    {
        $tiny_url = ShortLink::where('code', $code)->first();

        if(!$tiny_url)
            return to_route('shortener.app')->with('message', 'Cannot find element with code short ' . $code);

        $statistic = new Statistic(['visitor' => $request->ip()]);

        $tiny_url->statistics()->save($statistic);
    }


    /**
     * @param ShortenerRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ShortenerRequest $request): RedirectResponse
    {
        ShortLink::create([
            'url' => $request->url,
            'code' => $this->generateShortCode(),
            'ip_address' => $request->ip()
        ]);

        return to_route('shortener.app')->with('message', 'The URL has been shorted');
    }

    /**
     * Generate cryptographically secure random bytes
     * @param int $length
     * @return string
     * @throws Exception
     */
    protected function generateUniqId(int $length = 6): string
    {
        return substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);
    }

    /**
     * @param string $value
     * @return bool
     */
    protected function uniqIdExists(string $value): bool
    {
        return ShortLink::where('code', $value)->exists();
    }

    /**
     * Generate the code short code to be stored into the database
     * @return string
     * @throws Exception
     */
    protected function generateShortCode(): string
    {
        $code = $this->generateUniqId();
        $alreadyExists = $this->uniqIdExists($code);

        while ($alreadyExists) {
            $code = $this->generateUniqId();
            $alreadyExists = $this->uniqIdExists($code);
        }
        return $code;
    }
}
