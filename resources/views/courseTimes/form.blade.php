@inject('modules','App\Module')

@include('partials.others.form_content')

<div class="form-group">
    <div class="row">
        <label for="modules" class="col-md-4 text-right">关联模块</label>
        <div class="col-md-4">
            <select name="modules[]" id="modules" class="form-control js-example-basic-multiple" multiple>
                @foreach($modules::where('user_id', $user->id)->orderBy('name')->get() as $module)
                    <option value="{{ $module->id }}" @if(in_array($module->id, $moduleIds)) selected @endif>{{ $module->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@include('partials.others.form_button')

@section('scripts')
    <script type="text/javascript">
        $('.js-example-basic-multiple').select2();
    </script>
@stop
