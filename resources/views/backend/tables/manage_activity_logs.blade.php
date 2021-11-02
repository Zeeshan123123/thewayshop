<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<div class="bg-white">
    <table id="logs" class="stripe hover w-100 cus-table" style="margin:0px;width: 100%; margin-bottom: 31px; ">
        <thead>
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="2">Log detail</th>
                <th data-priority="5">Attributes</th>
                <th data-priority="6">Actions</th>
            </tr>
        </thead>
        <tbody>

        @foreach( $activity_logs as $activity )
            
            {{-- @dd($activity->properties) --}}
            {{-- with id: {{ $activity->log_name }} --}}
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->description }} with id: {{ ($activity->subject)? $activity->subject->id:'' }} by user with id: {{ ($activity->causer)? $activity->causer->id:'' }} </td>
                <td>
                    @if (strpos($activity->description, 'created') !== false) 
                        <span class="text-lg font-bold">Created at:</span> {{ $activity->created_at->diffForHumans() }}
                    @else 
                        <p class="text-lg font-bold">Old values:</p>
                        @foreach( $activity->properties['old'] as $key=>$value )
                            @if ( !$loop->first ) <br/> @endif
                            {{ $key }}: {!! $value !!}
                        @endforeach
                        <p class="text-lg font-bold">New values:</p>
                        @foreach( $activity->properties['attributes'] as $key=>$value )
                            @if ( !$loop->first ) <br/> @endif
                            {{ $key }}: {!! $value !!}
                        @endforeach
                    @endif
                </td>
                
                <td>
                    <div class="p-9">
                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-black-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                              <span class="ml-6 mr-5">Action</span>
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>

                            <ul class="dropdown-menu absolute hidden text-gray-700">
                                
                                <li>
                                    <a class="w-auto rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-10 block whitespace-no-wrap -mt-1" onclick="return confirm('Do you want to delete the this activity log?')" href="{{ route('activity.logs.delete',["id"=>Crypt::encrypt($activity->id)]) }}"> Delete &nbsp;</a>
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

        var table = $('#logs').DataTable( {
            "order": [[ 2, "asc" ]],
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } )
            .columns.adjust()
            .responsive.recalc();
    } );

</script>
