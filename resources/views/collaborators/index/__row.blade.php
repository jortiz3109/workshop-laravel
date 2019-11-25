<tr>
    <td>{{ $collaborator->name }}</td>
    <td>{{ $collaborator->email }}</td>
    <td>{{ $collaborator->city->name }}</td>
    <td>{{ $collaborator->role->name }}</td>
    <td>{{ $collaborator->isEnabled() ? __('Enabled') : __('Disabled') }}</td>
    <td class="text-right">
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('Collaborator actions') }}">
            <a href="{{ route('collaborators.show', $collaborator) }}" class="btn btn-link" title="{{ __('View') }}">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('collaborators.edit', $collaborator) }}" class="btn btn-link" title="{{ __('Edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            <button type="button" class="btn btn-link text-danger" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
