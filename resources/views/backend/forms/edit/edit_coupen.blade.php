<div class="lg:px-16 md:px-8 sm:px-4 px-4 border-b border-gray-300 text-base">
	<form action="{{ route('coupen.update') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="grid grid-cols-4 gap-4 border-b border-gray-300 text-base">

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Code')
                	@php($name = 'code')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ $coupen->$name }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Graphics" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Name')
                	@php($name = 'name')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ $coupen->$name }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ $label }}" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Amount')
                	@php($name = 'amount')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ $coupen->$name }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Graphics" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Amount Type')
                	@php($name = 'amount_type')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ $coupen->$name }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Graphics" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>


            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Expiry Date')
                	@php($name = 'expiry_date')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ $coupen->$name }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Graphics" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
	            <div class="my-2 text-sm">
	            	@php($label = 'Select Status')
                	@php($name = 'status')

	                <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <select name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ old($name) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" />
	                    <option value="">{{ __($label) }}</option>
	                    <option value="Enable" {{ "Enable" == $coupen->status ? 'selected' : ''}}>Enable</option>
	                    <option value="Disable" {{ "Disable" == $coupen->status ? 'selected' : ''}}>Disable</option>
	                </select>
	            </div>
	        </div>

	    </div>

	    {{-- Start: Input Hidden Fields --}}
        	<input type="hidden" name="coupen_id" value="{{Crypt::encrypt($coupen->id)}}">
        {{-- End: Input Hidden Fields --}}

		<div class="lg:col-span-1 md:col-span-1 sm:col-span-2 col-span-2 bg-red">
            <div class="my-7 text-sm">
                <button type="submit" class="md:w-60 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 rounded">Update Coupen</button>
            </div>
        </div>
		{{-- lg:col-span-2 md:col-span-2 sm:col-span-4 --}}

	</form>
</div>

