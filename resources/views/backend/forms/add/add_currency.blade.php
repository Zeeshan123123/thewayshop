<div class="lg:px-16 md:px-8 sm:px-4 px-4 border-b border-gray-300 text-base">
	<form action="{{ route('currency.store') }}" method="POST">
		@csrf

		{{-- Start: Form hidden fields --}}

		{{-- End: Form hidden fields --}}

		<div class="grid grid-cols-4 gap-4 border-b border-gray-300 text-base">

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Currency Code')
                	@php($name = 'currency_code')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>

                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ old($name) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ $label }}" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Currency Symbol')
                	@php($name = 'currency_symbol')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>

                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ old($name) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ $label }}" />
	                <span class="text-red-600" id="{{ $name }}-error"></span>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Exchange Rate')
                	@php($name = 'exchange_rate')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>

                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ old($name) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ $label }}" />
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
	                    <option value="active" {{ "active" == old($name) ? 'selected' : ''}}>Active</option>
	                    <option value="inactive" {{ "inactive" == old($name) ? 'selected' : ''}}>Inactive</option>
	                </select>
	            </div>
	        </div>

	    </div>

		<div class="lg:col-span-1 md:col-span-1 sm:col-span-2 col-span-2 bg-red">
            <div class="my-7 text-sm">
                <button type="submit" class="md:w-60 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 rounded">{{ __('Store Currency') }}</button>
            </div>
        </div>
		{{-- lg:col-span-2 md:col-span-2 sm:col-span-4 --}}

	</form>
</div>

