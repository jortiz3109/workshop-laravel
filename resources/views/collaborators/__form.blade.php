<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" value="{{ old('name', $collaborator->name) }}" required>
            @includeWhen($errors->has('name'), 'partials.__invalid_feedback', ['feedback' => $errors->first('name')])
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email', $collaborator->email) }}" required>
            @includeWhen($errors->has('email'), 'partials.__invalid_feedback', ['feedback' => $errors->first('email')])
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="city">{{ __('City') }}</label>
            <select class="form-control custom-select {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city" id="city" required>
                <option value="">{{ __('Please select a city') }}</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city', $collaborator->city_id) == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                @endforeach
            </select>
            @includeWhen($errors->has('city'), 'partials.__invalid_feedback', ['feedback' => $errors->first('city')])
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="role">{{ __('Role') }}</label>
            <select class="form-control custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role" id="role" required>
                <option value="">{{ __('Please select a role') }}</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role', $collaborator->role_id) == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                @endforeach
            </select>
            @includeWhen($errors->has('role'), 'partials.__invalid_feedback', ['feedback' => $errors->first('role')])
        </div>
    </div>
</div>
