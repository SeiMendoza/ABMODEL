@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Ocurrió un problema en el servidor :('))
