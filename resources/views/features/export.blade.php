<table>
    <thead>
        <tr>
            <td>#</td>
            <th class="min-w-125px">{{__('Feature')}}</th>
            <th class="min-w-125px">{{__('Name')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name en')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name H')}}</th>

            <th class="min-w-125px mw-350px">{{__('Active')}}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($features as $feature)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $feature->name }}</td>
                <td>{{ $feature->name_en}}</td>
                <td>{{ $feature->name_h }}</td>


                <td>{{ $feature->active==1? 'true' : 'false' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
