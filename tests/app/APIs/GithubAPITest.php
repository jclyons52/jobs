<?php

use App\APIs\Github\GithubAPI;

class GithubAPITest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_gets_jobs_from_api()
    {
        $github = new GithubAPI();

        $jobs = $github->getJobs([
            'search' => 'php'
        ]);

        $this->assertInstanceOf(\App\Job::class, $jobs[0]);
    }
}