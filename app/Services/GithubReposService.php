<?php

namespace App\Services;

use App\Models\Upvote;

class GithubReposService
{
    const GITHUB_REPO = 'https://api.github.com/users/ronizzle/repos';

    /**
     * @return string
     */
    protected function getRepoURL() : string
    {
        return env('GITHUB_REPO', self::GITHUB_REPO);
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllRepos()
    {
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient->get($this->getRepoURL());
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll()
    {
        $repos = $this->getAllRepos();

        foreach ($repos as $repoCtr => $repo) {

            $repo['repo_id'] = $repo['id'];
            /** @var  $upvote Upvote */
            $upvote = Upvote::where('repo_id', '=', $repo['repo_id'])->first();

            if($upvote instanceof Upvote) {

                $repo['upvote'] = [
                    'id' => $upvote->getAttribute('id'),
                    'count' => $upvote->getAttribute('count'),
                    'repo_id' => $upvote->getAttribute('repo_id'),
                ];

            } else {
                $repo['upvote'] = [
                    'id' => null,
                    'count' => 0,
                    'repo_id' => $repo['repo_id'] ,
                ];
            }

            $repos[$repoCtr] = $repo;
        }

        return $repos;
    }
}
