<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<div class="bg-white">
    <table id="categories" class="stripe hover w-100 cus-table" style="margin:0px;width: 100%; margin-bottom: 31px; ">
        <thead>
            <tr>
                <th data-priority="1">Code</th>
                <th data-priority="2">Name</th>
                <th data-priority="3">Amount</th>
                <th data-priority="4">Amount Type</th>
                <th data-priority="5">Status</th>
                <th data-priority="6">Expiry Date</th>
                <th data-priority="7">Created At</th>
                <th data-priority="8">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach( $coupens as $coupen )

            <tr>
                <td>{{ $coupen->code }}</td>
                <td>{{ $coupen->name }}</td>
                <td>{{ $coupen->amount }}</td>
                <td>{{ $coupen->amount_type }}</td>
                <td>{{ $coupen->status }}</td>
                <td>{{ $coupen->expiry_date }}</td>
                <td>{{ Carbon\Carbon::parse($coupen->created_at)->diffForHumans() }}</td>
                <td>
                    <div class="p-9">
                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-black-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                              <span class="ml-6 mr-5">Action</span>
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>

                            <ul class="dropdown-menu absolute hidden text-gray-700">
                                <li>
                                    <a class="w-auto rounded-t bg-gray-200 hover:bg-gray-400 py-0 px-14 block whitespace-no-wrap pt-2 -mt-1" href="{{ route('coupen.edit',["id"=>Crypt::encrypt($coupen->id)]) }}">Edit &nbsp</a>
                                </li>

                                <li>
                                    <a class="w-auto rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-8 block whitespace-no-wrap -mt-3" onclick="return confirm('Do you want to delete the coupen?')" href="{{ route('coupen.delete',["id"=>Crypt::encrypt($coupen->id)]) }}">Delete &nbsp;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>


<script>
    $(document).ready(function() {

        var table = $('#categories').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } )
            .columns.adjust()
            .responsive.recalc();
    } );

</script>
