<table>
    <thead>
        <tr>
            <td>#</td>
            <th class="min-w-125px">{{__('Review')}}</th>
            <th class="min-w-125px">{{__('Name')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name en')}}</th>
            <th class="min-w-125px mw-350px">{{__('Name H')}}</th>
            <th class="min-w-125px mw-350px">{{__('City')}}</th>
            <th class="min-w-125px mw-350px">{{__('Active')}}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $review->name }}</td>
                <td>{{ $review->name_en}}</td>
                <td>{{ $review->name_h }}</td>
                <td>{{ $review->city->name }}</td>

                <td>{{ $review->active==1? 'true' : 'false' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
