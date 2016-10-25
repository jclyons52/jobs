<?php
namespace App\Transformers;

use App\Job;
use JobApis\Jobs\Client\Schema\Entity\GeoCoordinates;
use League\Fractal;

class GithubJobTransformer extends Fractal\TransformerAbstract
{
    public function transform($obj)
    {
        $job = new Job;
        $job->url      = $obj->url;
        $job->title   = $obj->title;
        $job->description = $obj->description;
        $job->company = $obj->company;
        $job->address = $obj->location;
        $job->base_salary = $obj->baseSalary;
        $job->education_requirements = $obj->educationRequirements;
        $job->employment_type = $obj->employmentType;
        $job->experience_requirements = $obj->experienceRequirements;
        $job->industry = $obj->industry;
        $job->provider = 'github';
        if ($obj->jobLocation instanceof GeoCoordinates) {
            $job->lat = $obj->jobLocation->getGeo()->getLatitude();
            $job->lng = $obj->jobLocation->getGeo()->getLongitude();
        }

        
        return $job;
    }
}
