{{ csrf_field() }}

<div class="form-group">
    <div class="row">
        <label class="col-md-4 text-right">{{ $what }}名称:</label>
        <div class="col-md-4">
            <input id="name" name="name" class="form-control" value="{{ $name }}" required>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label class="col-md-4 text-right">{{ $what }}描述:</label>
        <div class="col-md-4">
            <textarea id="description" name="description" rows="5" class="form-control" required>{{ $description }}</textarea>
        </div>
    </div>
</div>

<input class="hidden" name="user_id" value="{{ $user->id }}">