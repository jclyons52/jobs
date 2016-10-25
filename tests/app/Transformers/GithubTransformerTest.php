<?php

use App\Job;
use App\Transformers\GithubJobTransformer;
use JobApis\Jobs\Client\Schema\Entity\JobPosting;

class GithubTransformerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_transforms_array_into_job()
    {
        $obj = new \JobApis\Jobs\Client\Job([
            "id" => "7a4f0e24-6ae8-11e6-8e27-b8bdf594908d",
            "created_at" => "Tue Oct 25 17:22:19 UTC 2016",
            "title" => "Application Engineer: Atom",
            "location" => "San Francisco or Remote ",
            "type" => "Full Time",
            "description" => "<p>GitHub&#39;s Atom team is looking for engineers to help build the world&#39;s most hackable text editor. The ideal candidate will be passionate about developer tools, delivering a top-notch editing experience, and participating in Atom&#39;s passionate open source community. </p>",
            "how_to_apply" => "<p>Apply on our careers page: <a href=\"https://jobs.lever.co/github/baaa9a2c-c249-4d06-b73f-e9bee1a3d147\">https://jobs.lever.co/github/baaa9a2c-c249-4d06-b73f-e9bee1a3d147</a></p>\n",
            "company" => "GitHub",
            "company_url" => "https://jobs.lever.co/github/baaa9a2c-c249-4d06-b73f-e9bee1a3d147",
            "company_logo" => "http://github-jobs.s3.amazonaws.com/74a830d6-6ae8-11e6-929a-17c693a9b6d8.png",
            "url" => "http://jobs.github.com/positions/7a4f0e24-6ae8-11e6-8e27-b8bdf594908d"
        ]);

        $transformer = new GithubJobTransformer();

        $result = $transformer->transform($obj);

        $this->assertInstanceOf(Job::class, $result);
    }
}