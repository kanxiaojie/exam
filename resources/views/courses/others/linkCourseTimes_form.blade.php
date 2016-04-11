<div class="mainpanel">
    <div class="contentpanel">
        <div class="panel-body">
            <h4>{{ $ifLinked }}课时</h4>
            <hr/>

            <form method="post" action="/courses/{{ $id }}/linkCourseTimes/{{ $ifLink }}">
                {{ csrf_field() }}

                <table id="{{ $my_table }}" class="table table-bordered text-center">
                    <thead class="dynatable-active-page">
                    <tr>
                        <th>
                            <input type="checkbox" id="{{ $checkButton }}" {{$ifCheck}}>
                        </th>
                        <th>课时名称</th>
                        <th>课时描述</th>
                        <th>相关模块</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($ifLinkCourseTimes as $courseTime)
                            <tr>
                                <td>
                                    <input type="checkbox" class="{{ $check }}" name="courseTime[]"
                                           value="{{ $courseTime->id }}" {{ $ifCheck }}>
                                </td>
                                <td>{{ $courseTime->name }}</td>
                                <td>{{ $courseTime->description }}</td>
                                <td>
                                    @foreach($courseTime->modules()->orderBy('name')->get() as $module)
                                        {{ $module->name }}&nbsp;&nbsp;
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center" style="margin-top: 40px; margin-bottom: 20px">
                    <button type="submit" class="button button-border button-rounded {{ $button_type }}">{{ $button_name }}</button>
                </div>
            </form>
        </div>
    </div>
</div>