@extends('metronic.index')

@section('title', 'Settings - Department & Speciality ')
@section('subpageTitle', 'Settings')
@section('subpageName', 'Department & Speciality ')

@section('content')
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        @include('division.departments.index')

        @include('division.speciality.index')
    </div>
@endsection
