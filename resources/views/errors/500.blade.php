@extends('errors.layout')

@section('title', trans('helix::pages.serverError'))

@section('code', '500')

@section('text', trans('helix::pages.serverError'))

@section('additional')
	<p>{!! trans('helix::pages.contactAdminIfErrorPersists', ['email' => 'hucon@huconglobal.com'])  !!}</p>
@endsection

@section('icon', 'times')