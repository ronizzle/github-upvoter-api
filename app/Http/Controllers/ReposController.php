<?php

namespace App\Http\Controllers;

use App\Services\GithubReposService;
use Illuminate\Http\Request;


class ReposController extends Controller
{
    /**
     * @param GithubReposService $githubReposService
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(GithubReposService $githubReposService)
    {
        return $githubReposService->getAll();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function upvote(Request $request) {

        return json_decode(
            [
                'repo_id' => $request->get('repo_id'),
            ]
        );
    }
}
