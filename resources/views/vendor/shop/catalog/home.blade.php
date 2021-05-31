@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>
    <?= $aiheader['basket/mini'] ?? '' ?>
    <?= $aiheader['catalog/home'] ?? '' ?>
@stop

@section('aimeos_head')
    <?= $aibody['basket/customized'] ?? '' ?>
    <?= $aibody['locale/select'] ?? '' ?>
@stop

@section('aimeos_body')
    <?= $aibody['catalog/home'] ?? '' ?>
    <?= $aibody['test/customized'] ?? '' ?>
@stop
