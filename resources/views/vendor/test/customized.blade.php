@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['test/customized'] ?? '' ?>
@stop

@section('aimeos_body')
    <?= $aibody['test/customized'] ?? '' ?>
@stop
