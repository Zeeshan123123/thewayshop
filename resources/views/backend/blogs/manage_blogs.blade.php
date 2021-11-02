<x-app-layout>

    <x-slot name="title">
        {{$page_title}}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($page_title) }}
        </h2>
    </x-slot>




    <div class=" px-24 mt-8">

        {{-- Start: Alerts --}}
        @include('layouts.alerts')
        {{-- End: Alerts --}}

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="px-4 flex-auto">
                        <a href="{{ route('blog.create') }}" class="mt-3 mb-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-12 text-xl float-left">Add Blog</a>

                        {{-- Start: Open Projects --}}
                        <div class="block h-72 py-16 text-center">
                            @include('backend.tables.manage_blogs')
                        </div>
                        {{-- End: Open Projects --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-gray-700 h-16 mt-56"></div>


</x-app-layout>
