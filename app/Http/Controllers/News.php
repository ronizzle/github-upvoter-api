<?php

namespace App\Http\Controllers;

use App\Services\GithubReposService;
use Illuminate\Http\Request;

class News extends Controller
{
    public function index(GithubReposService $githubReposService) {
        return $githubReposService->getAll();

    }
}
