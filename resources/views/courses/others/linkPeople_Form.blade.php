<div class="mainpanel">
    <div class="contentpanel">
        <div class="panel-body">
            <h4>{{ $ifLinked }}学生</h4>
            <hr/>

            <form method="post" action="/courses/{{ $id }}/{{ $action }}/{{ $ifLink }}">
                {{ csrf_field() }}

                <table id="{{ $my_table }}" class="table table-bordered text-center">
                    <thead class="dynatable-active-page">
                    <tr>
                        <th>
                            <input type="checkbox" id="{{ $checkButton }}" {{$ifCheck}}>
                        </th>
                        <th>{{ $whoseId }}</th>
                        <th>{{ $whoseName }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ifLinkPeople as $person)
                        <tr>
                            <td>
                                <input type="checkbox" class="{{ $check }}" name="person[]"
                                       value="{{ $person->id }}" {{ $ifCheck }}>
                            </td>
                            <td>{{ $person->student_id }}</td>
                            <td>{{ $person->name }}</td>
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