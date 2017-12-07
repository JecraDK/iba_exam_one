@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <h1 class="main-title">Edit profile (* required)</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">


            @if(\Session::has('message'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ \Session::get('message') }}</strong>
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('account.save',$user) }}">

                <input type="hidden" name="_method" value="PUT" />
                {{ csrf_field() }}




                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label"> Full Name *</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of name -->




                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address *</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!-- end of email -->



                <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                    <label for="day" class="col-md-4 control-label">Date of birth *</label>
                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-sm-4">
                                <select title="day" id="day" class="form-control" name="day" >
                                    <option value="">Day</option>
                                    @for ($day = 01; $day <= 31; $day++)
                                        @if(isset($user->birth_date) && $day == \Carbon\Carbon::createFromFormat('d-m-Y',$user->birth_date)->format('d'))
                                            <option value="{{ $day }}" selected="selected">{{ $day }}</option>
                                        @else
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endif
                                    @endfor
                                </select>
                                @if ($errors->has('day'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-sm-4">
                                <select title="month" id="month" class="form-control" name="month">
                                    <option value="">Month</option>
                                    @for ($month = 01; $month <= 12; $month++)
                                        @if(isset($user->birth_date) &&  $month == \Carbon\Carbon::createFromFormat('d-m-Y',$user->birth_date)->format('m'))
                                            <option value="{{ $month }}" selected="selected">{{ $month }}</option>
                                        @else
                                            <option value="{{ $month }}">{{ $month }}</option>
                                        @endif
                                    @endfor
                                </select>
                                @if ($errors->has('month'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <select title="year" id="year" class="form-control" name="year">
                                    <option value="">Year</option>
                                    @for ($year = 1960; $year <= 2020; $year++)
                                        @if(isset($user->birth_date) &&  $year == \Carbon\Carbon::createFromFormat('d-m-Y',$user->birth_date)->format('Y'))
                                            <option value="{{ $year }}" selected="selected">{{ $year }}</option>
                                        @else
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endif
                                    @endfor
                                </select>
                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- end of birth_date -->




                <div class="form-group{{ $errors->has('user_city') ? ' has-error' : '' }}">
                    <label for="user_city" class="col-md-4 control-label">City *</label>
                    <div class="col-md-6">
                        <input id="user_city" type="text" class="form-control" name="user_city" value="{{ $user->user_city }}" required autofocus>

                        @if ($errors->has('user_city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_city') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of user_city -->




                <div class="form-group{{ $errors->has('user_country') ? ' has-error' : '' }}">
                    <label for="user_country" class="col-md-4 control-label">Country *</label>
                    <div class="col-md-6">
                        <input id="user_country" type="text" class="form-control" name="user_country" value="{{ $user->user_country }}" required autofocus>

                        @if ($errors->has('user_country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_country') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of user_country -->




                <div class="form-group{{ $errors->has('languages') ? ' has-error' : '' }}">
                    <label for="languages" class="col-md-4 control-label">Languages *</label>
                    <div class="col-md-6">
                        <input id="languages" type="text" class="form-control" name="languages" value="{{ $user->languages }}" required autofocus>

                        @if ($errors->has('languages'))
                            <span class="help-block">
                                <strong>{{ $errors->first('languages') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of languages -->




                <div class="form-group{{ $errors->has('competences') ? ' has-error' : '' }}">
                    <label for="competences" class="col-md-4 control-label">Competences: PHP, Java etc * </label>
                    <div class="col-md-6">
                        <input id="competences" type="text" class="form-control" name="competences" value="{{ $user->competences }}" required autofocus>

                        @if ($errors->has('competences'))
                            <span class="help-block">
                                <strong>{{ $errors->first('competences') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of competences -->




                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    <label for="phone_number" class="col-md-4 control-label">Mobile Number</label>
                    <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control"  name="phone_number" value="{{ $user->phone_number }}" autofocus>

                        @if ($errors->has('phone_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of phone number -->




                <div class="form-group">
                    <label for="is_available" class="col-md-4 control-label">Are you available to look for jobs?</label>
                    <div class="col-md-6">
                        <input id="is_available" type="checkbox" class="form-control"  name="is_available" value="1" @if($user->is_available) checked="checked" @endif />

                        @if ($errors->has('is_available'))
                            <span class="help-block">
                                <strong>{{ $errors->first('is_available') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> <!--end of is_available-->




                <div class="form-group{{ $errors->has('job_type') ? ' has-error' : '' }}">
                    <label for="job_type" class="col-md-4 control-label">What kind of Job Seeker are you?</label>
                    <div class="col-md-4">
                        <div class="form-check">
                            <label for="is_freelancer" class="form-check-label">
                                Freelancer
                                <input id="is_freelancer" type="checkbox" class="form-check-input"  name="is_freelancer" value="1" @if($user->is_freelancer) checked="checked" @endif />
                            </label>
                        </div>

                    </div><!--end of freelancer -->
                    <div class="col-md-4">
                        <div class="form-check">
                            <label for="is_permanent" class="form-check-label">
                                Permanent
                                <input id="is_permanent" type="checkbox" class="form-check-input"  name="is_permanent" value="1" @if($user->is_permanent) checked="checked" @endif />
                            </label>
                        </div>

                    </div><!--end of permanent -->
                </div> <!--end of job_type-->

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password*</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" >

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div> <!--end of password -->

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password*</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                    </div>
                </div> <!-- end of confirm password -->

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>




@endsection