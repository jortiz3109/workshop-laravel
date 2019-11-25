@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">{{ __('Collaborators') }}</h5>
        </div>
        <div class="table-responsive-lg">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                @each('collaborators.index.__row', $collaborators, 'collaborator', 'partials.__empty')
                </tbody>
            </table>
        </div>
    </div>
@endsection
