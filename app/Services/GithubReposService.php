<?php

namespace App\Services;

class GithubReposService
{
    public function getAll()
    {
        $httpClient = new \GuzzleHttp\Client();
        $request =
            $httpClient
                ->get(env('GITHUB_REPO'));

        return json_decode($request->getBody()->getContents());
    }
}
