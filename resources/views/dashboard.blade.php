<?php
    $notifications = \DB::table('notifications')->whereNull('read_at')->orderBy('created_at','DESC')->get();
    /* Test Code
    $product_code = new \App\Models\ProductCode;
    dd($product_code->checkStock(28));
    */
?>

<style>
    .alert {
        width: 89% !important;
    }
</style>

<x-app-layout>
    @php($title = 'Dashboard')
    <x-slot name="title">
{{--        {{$title}}--}}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if( auth()->user()->role == "admin" )
        @forelse ($notifications as $notification)
            <?php
                $detail = json_decode($notification->data, true);
            ?>
            {{-- Commented for a while
            @if( $loop->first )
                <div class="ml-20">
                    <div class="flex text-green-700 font-semibold">
                        <a href="#" class="float-right mark-all" data-id="{{ $notification->id }}">
                            Mark all as read
                        </a>
                    </div>
                </div>
            @endif
            --}}

            <div class="ml-20 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md w-50 alert" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                      <p class="font-bold">[{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}]  </p>
                      <p class="font-semi-bold">{{ $detail['details'] }}</p>
                    </div>
                </div>

                <div class="flex text-green-600 div-mark-as-red">
                    <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                        Mark as read
                    </a>
                </div>
            </div>
        @empty
            <h5>There are no new notifications.</h5>
        @endforelse
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1>Welcome {{ Auth::user()->name }}</h1>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>

<script>
    function sendMarkRequest( id = null ) {
        let _token   = $('meta[name="csrf-token"]').attr('content');

        return $.ajax(
            "{{ route('mark.notification') }}",
            {
                method: 'POST',
                data: {
                    _token,
                    id,
                }
            }
        );
    }

    $( function() {
        $( '.mark-as-read' ).click( function () {
            let request = sendMarkRequest( $(this).data('id') );

            request.done( () => {
                $(this).parent().parent('div.alert').remove();
            });
        });

        $( '.mark-all' ).click( function () {
            let request = sendMarkRequest( $this.data('id') );

            request.done( () => {
                $('div.alert').remove();
            });
        });

    });
</script>
