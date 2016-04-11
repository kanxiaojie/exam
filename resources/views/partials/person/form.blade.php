{{ csrf_field() }}

<div class="form-group">
    <div class="row">
        <label for="student_id" class="col-md-4 text-right">{{ $whoseId }}:</label>
        <div class="col-md-4">
            <input type="text" name="student_id" id="student_id" class="form-control" value="{{ $student_id }}" required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="name" class="col-md-4 text-right">{{ $who }}姓名:</label>
        <div class="col-md-4">
            <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" required>
        </div>
    </div>
</div>

<input type="hidden" name="role_id" value="{{ $roleId }}">

<div class="form-group text-center">
    <div class="row">
        <button type="submit" class="btn btn-info btn-q">确定</button>
        <a onclick="javascript:window.location.href=history.back()" class="btn btn-default btn-q">取消</a>
    </div>
</div>








