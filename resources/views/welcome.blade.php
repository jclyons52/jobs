@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <search></search>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                 
                    <div class="panel-heading">
                        Jobs
                    </div>
                    <div class="panel-body">
                         <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                            <a href="#all-jobs" aria-controls="all-jobs" role="tab" data-toggle="tab">PHP Australia Jobs</a>
                            </li>
                            <li role="presentation">
                            <a href="#github-jobs" aria-controls="my-jobs" role="tab" data-toggle="tab">Github Jobs</a>
                            </li>
                             <li role="presentation">
                                 <a href="#indeed-jobs" aria-controls="my-jobs" role="tab" data-toggle="tab">Indeed Jobs</a>
                             </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="all-jobs">
                                <joblist base_url="/api/v1/jobs" ></joblist>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="github-jobs">
                                <joblist base_url="/api/v1/jobs/github" ></joblist>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="indeed-jobs">
                                <joblist base_url="/api/v1/jobs/indeed" ></joblist>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection
