<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<div class="bg-white">
    <table id="blogs" class="stripe hover w-100 cus-table" style="margin:0px;width: 100%; margin-bottom: 31px; ">
        <thead>
            <tr>
                <th data-priority="1">Title</th>
                <th data-priority="2">Slug</th>
                <th data-priority="3">Description</th>
                <th data-priority="4">Status</th>
                <th data-priority="5">Created At</th>
                <th data-priority="6">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach( $blogs as $blog )

            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->slug }}</td>
                <td>{!! strlen($blog->description) > 30 ? substr($blog->description,0,30)."..." : $blog->description !!}</td>
                <td class="{{($blog->status == 'active')?'text-green-500':'text-yellow-500'}}">{{ $blog->status }}</td>
                <td>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</td>
                <td>
                    <div class="p-9">
                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-black-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                              <span class="ml-6 mr-5">Action</span>
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>

                            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                <li>
                                    <a class="w-auto rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-8 block whitespace-no-wrap -mt-1" href="{{ route('blog.edit',["id"=>Crypt::encrypt($blog->id)]) }}">Edit blog &nbsp;</a>
                                </li>

                                <li>
                                    <a class="w-auto rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-8 block whitespace-no-wrap -mt-1" onclick="return confirm('Do you want to delete the blog?')" href="{{ route('blog.delete',["id"=>Crypt::encrypt($blog->id)]) }}">Delete &nbsp;</a>
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

        var table = $('#blogs').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } )
            .columns.adjust()
            .responsive.recalc();
    } );

</script>
