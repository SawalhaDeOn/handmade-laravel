<table>
    <thead>
        <tr>
            <td>#</td>
            <th class="min-w-125px">{{__('Service')}}</th>
            <th class="min-w-125px">{{__('Name')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name en')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name H')}}</th>

            <th class="min-w-125px mw-350px">{{__('Active')}}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->name_en}}</td>
                <td>{{ $service->name_h }}</td>


                <td>{{ $service->active==1? 'true' : 'false' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
