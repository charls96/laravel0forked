<form method="get" action="{{ route('professions.index') }}">
    <div class="col-md-12 text-right">
        <div class="form-inline form-dates">
            <label for="date_start" class="form-label-sm">Fecha</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" name="from" id="from"
                    value="{{ request('from') }}" placeholder="Desde">
            </div>
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" name="to" id="to" value="{{ request('to') }}"
                    placeholder="Hasta">
            </div>
            &nbsp;
            <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
        </div>
    </div>
</form>
