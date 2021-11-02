<div class="lg:px-16 md:px-8 sm:px-4 px-4 border-b border-gray-300 text-base">
	<form action="{{ route('subcategory.update') }}" method="POST" enctype="multipart/form-data">
		@csrf

		{{-- Start: Form hidden fields --}}

		{{-- End: Form hidden fields --}}

		<div class="grid grid-cols-4 gap-4 border-b border-gray-300 text-base">

            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Select Category')
                	@php($name = 'category')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <select name="{{ $name }}" type="text" autofocus id="{{ $name }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" />
                        <option value="">{{ __($label) }}</option>
                        @foreach( $categories as $category )
                            <option value="{{$category->id}}" {{ $category->id == $subcategory->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                	@php($label = 'Sub Category Title')
                	@php($name = 'title')

                    <label for="{{ $name }}" class="block text-black font-semibold">{{ __($label) }}
                    	<span class="text-red-600" value="*">*</span>
                    </label>
                    
                    <input name="{{ $name }}" type="text" autofocus id="{{ $name }}" value="{{ $subcategory->title }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Beauty cream" />
	                <span class="red-text" id="{{ $name }}-error" style=" color: red; "></span>
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
	                    <option value="active" {{ "active" == $subcategory->status ? 'selected' : ''}}>Active</option>
	                    <option value="inactive" {{ "inactive" == $subcategory->status ? 'selected' : ''}}>Inactive</option>
	                </select>
	            </div>
	        </div>

	    </div>

	    {{-- Start: Input Hidden Fields --}}
        	<input type="hidden" name="subcategory_id" value="{{Crypt::encrypt($subcategory->id)}}">
        {{-- End: Input Hidden Fields --}}

		<div class="lg:col-span-1 md:col-span-1 sm:col-span-2 col-span-2 bg-red">
            <div class="my-7 text-sm">
                <button type="submit" class="md:w-60 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 rounded">Update Sub Category</button>
            </div>
        </div>
		{{-- lg:col-span-2 md:col-span-2 sm:col-span-4 --}}

	</form>
</div>

