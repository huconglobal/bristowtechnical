@extends('errors.layout')

@section('title', trans('helix::pages.denied'))

@section('code', '403')

@section('text', trans('helix::pages.denied'))

@section('additional')
    <p>@lang('helix::pages.missingPermission')</p>
@endsection

@section('icon', 'lock')