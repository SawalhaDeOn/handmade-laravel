<table>
    <thead>
        <tr>
            <td>#</td>
            <th class="min-w-125px">{{__('Slider')}}</th>
            <th class="min-w-125px">{{__('Name')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name en')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name H')}}</th>

            <th class="min-w-125px mw-350px">{{__('Active')}}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($sliders as $slider)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->name_en}}</td>
                <td>{{ $slider->name_h }}</td>


                <td>{{ $slider->active==1? 'true' : 'false' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
