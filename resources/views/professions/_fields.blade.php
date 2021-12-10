{{ csrf_field() }}

<div class="form-group">
    <label for="title">Nombre de la profesión:</label>
    <input type="text" name="title" value="{{ old('title', $profession->title) }}" class="form-control">
</div>
