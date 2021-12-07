{{ csrf_field() }}

<div class="form-group">
    <label for="first_name">Nombre:</label>
    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control">
</div>
<div class="form-group">
    <label for="last_name">Apellidos:</label>
    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control">
</div>
<div class="form-group">
    <label for="email">Correo Electrónico</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
</div>
<div class="form-group">
    <label for="password">Contraseña: </label>
    <input type="password" name="password" class="form-control">
</div>
<div class="form-group">
    <label for="repeat_password">Repetir contraseña: </label>
    <input type="password" name="repeat_password" class="form-control">
</div>
<div class="form-group">
    <label for="bio">Biografía</label>
    <textarea type="text" name="bio" class="form-control">{{ old('bio', $user->profile->bio) }}</textarea>
</div>
<div class="form-group">
    <label for="twitter">Twitter</label>
    <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $user->profile->twitter) }}"
        placeholder="URL de tu usuario de Twitter">
</div>
<div class="form-group">
    <label for="github">Github</label>
    <input type="text" name="github" class="form-control" value="{{ old('github', $user->profile->github) }}"
        placeholder="URL de tu usuario de Github">
</div>
<div class="form-group">
    <label for="profession_id">Profesión</label>
    <select name="profession_id" id="profession_id" class="form-control">
        <option value="">Selecciona una opción</option>
        @foreach ($professions as $profession)
            <option value="{{ $profession->id }}"
                {{ old('profession_id', $user->profile->profession_id) == $profession->id ? 'selected' : '' }}>
                {{ $profession->title }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="annual_salary">Salario Anual</label>
    <input type="number" name="annual_salary" class="form-control" value="{{ old('annual_salary', $user->profile->annual_salary) }}">
</div>

<h5>Habilidades</h5>

@foreach ($skills as $skill)
    <div class="form-check form-check-inline">
        <input name="skills[{{ $skill->id }}]" class="form-check-input" type="checkbox"
            id="skill_{{ $skill->id }}" value="{{ $skill->id }}"
            {{ $errors->any() ? old('skills.' . $skill->id) : ($user->skills->contains($skill) ? ' checked' : '') }}>
        <label class="form-check-label" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
    </div>
@endforeach

<h5 class="mt-3">Rol</h5>

@foreach (trans('users.roles') as $role => $name)
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="role" id="role_{{ $role }}"
            value="{{ $role }}" {{ old('role', $user->role) == $role ? ' checked' : '' }}>
        <label class="form-check-label" for="role_{{ $role }}">{{ $name }}</label>
    </div>
@endforeach

<h5 class="mt-3">Estado</h5>

@foreach (trans('users.states') as $state => $label)
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="state" id="state_{{ $state }}"
            value="{{ $state }}" {{ old('state', $user->state) == $state ? ' checked' : '' }}>
        <label class="form-check-label" for="state_{{ $state }}">{{ $label }}</label>
    </div>
@endforeach
