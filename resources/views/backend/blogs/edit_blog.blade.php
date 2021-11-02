<x-app-layout>
    <x-slot name="title">
        {{ $page_title }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($page_title) }}
        </h2>
    </x-slot>

    @section('styles')
    	<link rel="stylesheet" type="text/css" href="{{ASSETS}}css/backend_styles.css">
    @endsection

  	<section class="relative py-16 lg:px-16 md:px-8 sm:px-2">


		<div id="tabs" class="lg:text-xl">

			<div class="grid grid-cols-4 gap-4">

					<div class="lg:col-span-1 md:col-span-1 sm:col-span-4 col-span-4 bg-white h-content shadow-xl rounded-xl">
						<div class="abc">	
							<ul class="w_ful">
								<li><a href="#tabs-1" class="w_full pl-12" onclick="appendTabUrl('#tabs-1')">{{ __('Edit Blog') }}</a></li>
							</ul>
						</div>
					</div>

					<div class="lg:col-span-3 md:col-span-3 sm:col-span-4 col-span-4 bg-white shadow-xl rounded-xl">
						<div class="tab-contentss">

							<!-- Start: Alert Messages -->
			        			@include('layouts.alerts')
			        		<!-- End: Alert Messages -->
							
							{{-- ===================== tab-1 of blog information  ============================ --}}
							
							<div id="tabs-1">
								
				        		<h1 class="text-xl font-bold lg:px-16 md:px-8 sm:px-2 px-2 py-10 border-b border-gray-300 text-base"> {{ucfirst(str_replace('_', ' ', $form_data['form_title']))}}</h1>

				        		<!-- Start: Post Project Form -->
				        			@include('backend.forms.edit.edit_blog')
				        		<!-- End: Post Project Form -->
							</div>
						</div>
					</div>
				</div>

		</div>
	</section>

	<div class="bg-gray-700 h-16 mt-20"></div>
</x-app-layout>


<script>
$( function() {
	$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
} );
</script>





