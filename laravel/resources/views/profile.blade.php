@extends('layouts.app')

@section('content')
    <div class="container">
        <h1><b>Your Profile</b></h1>
        <form method="post" action="{{ url('/users/update') }}" enctype="multipart/form-data">
            <div class="form-group hidden">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="put">
            </div>
            <div class="form-group">
                <?php if ($user->avatar) :?>
                <img style="max-width: 200px; max-height: 200px;" class="img-thumbnail" src="<?php echo \Storage::url($user->avatar); ?>"/>
                <?php endif;?>
                <label for="avatar" class="control-label"><b>{{ __('Avatar (optional)') }}</b></label>
                <input id="avatar" type="file" class="form-control" name="avatar">
            </div>
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label"><b>{{ __('Name') }}</b></label>
                <input type="text" name="name" placeholder="{{ __('Please enter your name here') }}" class="form-control"
                       value="{{ $user->name }}"/>

                <?php if ($errors->has('name')) :?>
                <span class="help-block">
                    <strong>{{$errors->first('name')}}</strong>
                </span>
                <?php endif;?>

            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label"><b>{{ __('Email') }}</b></label>
                <input type="text" name="email" placeholder="{{ __('Please enter your email here') }}" class="form-control"
                       value="{{ $user->email }}"/>

                <?php if ($errors->has('email')) :?>
                <span class="help-block">
                    <strong>{{$errors->first('email')}}</strong>
                </span>
                <?php endif;?>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default"> Submit</button>
            </div>
        </form>
    </div>
@endsection
