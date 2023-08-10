@extends('errors.minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('head', 'Alto ahí!')
@section('img', '/img/errorWeb.jpg')
@section('message', __('Problemas en el servidor :('))
