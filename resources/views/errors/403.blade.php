@extends('errors.layout')

@section('title', __('Prohibido'))
@section('img', '/img/stop.gif')
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'No puedes realizar esta acción'))
