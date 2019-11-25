@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">{{ $collaborator->name }}</h5>
            <div>
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('collaborators.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>

                    <a href="{{ route('collaborators.edit', $collaborator) }}" class="btn btn-secondary">
                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                    </a>

                    <button type="button" class="btn btn-danger" data-route="{{ route('collaborators.destroy', $collaborator) }}" data-toggle="modal" data-target="#confirmDeleteModal">
                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-md-3">{{ __('Name') }}</dt>
                <dd class="col-md-3">{{ $collaborator->name }}</dd>

                <dt class="col-md-3">{{ __('Email') }}</dt>
                <dd class="col-md-3">{{ $collaborator->email }}</dd>

                <dt class="col-md-3">{{ __('Role') }}</dt>
                <dd class="col-md-3">{{ $collaborator->role->name }}</dd>

                <dt class="col-md-3">{{ __('City') }}</dt>
                <dd class="col-md-3">{{ $collaborator->city->name }}</dd>
            </dl>

            <div class="card card-default">
                <div class="card-header">{{ __('Assigned tasks') }}</div>
                <div class="card-body">
                    @includeWhen($collaborator->hasTasks(), 'collaborators.__task_list', ['tasks' => $collaborator->tasks])
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modals')
    @include('partials.__confirm_delete_modal')
@endpush
@push('scripts')
    <script src="{{ asset(mix('js/delete-modal.js')) }}"></script>
@endpush
