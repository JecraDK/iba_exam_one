@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <h1 class="main-title">Show profile</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">

            <form class="form-horizontal">

                <div class="form-group">
                    <div class="col-md-4 control-label"> <strong>Full Name </strong></div>
                    <div class="col-md-6">
                         {{ $user->name }}
                    </div>
                </div> <!--end of name -->

                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> E-Mail Address </strong></div>

                    <div class="col-md-6">
                        <div>{{ $user->email }} </div>
                    </div>
                </div> <!-- end of email -->


                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> Date of birth </strong></div>
                    <div class="col-md-6">
                        <div>{{ $user->birth_date }} </div>
                    </div>
                </div> <!-- end of birth_date -->


                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> City </strong></div>
                    <div class="col-md-6">
                        <div>{{ $user->user_city }} </div>
                    </div>
                </div> <!--end of user_city -->


                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> Country </strong></div>
                    <div class="col-md-6">
                        <div>{{ $user->user_country }} </div>
                    </div>
                </div> <!--end of user_country -->


                <div class="form-group">
                    <div class="col-md-4 control-label"><strong>Languages </strong></div>
                        <div class="col-md-6">
                            <div>{{ $user->languages }} </div>
                        </div>
                </div> <!--end of languages -->




                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> Competences: PHP, Java etc </strong></div>
                    <div class="col-md-6">
                        <div>{{ $user->competences }} </div>
                    </div>
                </div> <!--end of competences -->


                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> Mobile Number </strong></div>
                    <div class="col-md-6">
                        <div>{{ $user->phone_number }} </div>
                    </div>
                </div> <!--end of phone number -->


                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> Are you available to look for jobs? </strong></div>
                    <div class="col-md-6">
                        <input id="is_available" type="checkbox" class="form-control"  onclick="return false" name="is_available" value="1" @if($user->is_available) checked="checked" @endif />
                    </div>
                </div> <!--end of is_available-->

                <div class="form-group">
                    <div class="col-md-4 control-label"><strong> What kind of Job Seeker are you? </strong></div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <div class="form-check-label">
                                Freelancer
                                <input id="is_freelancer" type="checkbox" onclick="return false" class="form-check-input"  name="is_freelancer" @if($user->is_freelancer) checked="checked" @endif />
                            </div>
                        </div>
                    </div><!--end of freelancer -->
                    <div class="col-md-4">
                        <div class="form-check">
                            <div class="form-check-label">
                                Permanent
                                <input id="is_permanent" type="checkbox" onclick="return false" class="form-check-input"  name="is_permanent" value="1" @if($user->is_permanent) checked="checked" @endif />
                            </div>
                        </div>
                    </div><!--end of permanent -->
                </div> <!--end of job_type-->
            </form>
        </div>
    </div>
@endsection