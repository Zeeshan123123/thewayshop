<div class="lg:px-16 md:px-8 sm:px-4 px-4 border-b border-gray-300 text-base">
	<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="grid grid-cols-4 gap-4 border-b border-gray-300 text-base">

            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
                <div class="my-2 text-sm">
                    <label for="{{$form_data['category']}}" class="block text-black font-semibold">{{ __('Select') }} {{ucfirst(str_replace('_', ' ', $form_data['category']))}}
                    	<span class="text-red-600" value="*">*</span>
                    </label>

                    <select name="{{$form_data['category']}}" type="text" autofocus id="{{$form_data['category']}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Ecommerce Success Story" />
                        <option value="">Select Category</option>
                        @foreach( $categories as $category )
                            <option value="{{$category->id}}" {{ $category->id == old($form_data['category']) ? 'selected' : ''}}>{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['title']}}" class="block text-black font-semibold">Enter Product {{ucfirst(str_replace('_', ' ', $form_data['title']))}}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <input name="{{$form_data['title']}}" type="text" autofocus id="{{$form_data['title']}}" value="{{ old($form_data['title']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Ecommerce Success Story" />
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['slug']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['slug'])) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <input name="{{$form_data['slug']}}" type="text" autofocus id="slug" value="{{ old($form_data['slug']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. build-a-website" />
	                <span class="red-text" id="{{$form_data['slug']}}-error" style=" color: red; "></span>
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['codes']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['codes'])) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <input name="{{$form_data['codes']}}[]" type="number" autofocus id="{{$form_data['codes']}}" value="{{ old($form_data['codes']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="" />
	                <span class="red-text" id="{{$form_data['codes']}}-error" style=" color: red; "></span>
	            </div>
			</div>

			<div id="new-code-row" class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red"></div>
			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
					<a id="add-code-row" class="md:w-72 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 rounded cursor-pointer">Add another code</a>
				</div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['images']}}" class="block text-black font-semibold">Select {{ ucfirst(str_replace('_', ' ', $form_data['images'])) }}</label>
	                <input name="{{$form_data['images']}}[]" type="file" autofocus id="image" value="{{ old($form_data['images']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" multiple />
	                <span class="red-text" id="{{$form_data['images']}}-error" style=" color: red; "></span>

	                <small>Image must be jpeg,png,jpg,svg.</small>
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['short_description']}}" class="block text-black font-semibold">Enter Description
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <textarea id="{{$form_data['short_description']}}" name="{{$form_data['short_description']}}" type="text" autofocus id="{{$form_data['short_description']}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="Describe about the product." rows="3"/>{{ old($form_data['short_description']) }}</textarea>
	            </div>
	        </div>

	        {{-- <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['long_description']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['long_description'])) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <textarea id="{{$form_data['long_description']}}" name="{{$form_data['long_description']}}" type="text" autofocus id="{{$form_data['long_description']}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="Describe about the product." rows="3"/>{{ old($form_data['long_description']) }}</textarea>
	            </div>
	        </div> --}}

	        <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['meta_title']}}" class="block text-black font-semibold">Enter {{ucfirst(str_replace('_', ' ', $form_data['meta_title']))}}</label>
	                <input name="{{$form_data['meta_title']}}" type="text" autofocus id="{{$form_data['meta_title']}}" value="{{ old($form_data['meta_title']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Ecommerce Success Story" />
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['meta_description']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['meta_description'])) }}</label>
	                <textarea id="{{$form_data['meta_description']}}" name="{{$form_data['meta_description']}}" type="text" autofocus id="{{$form_data['meta_description']}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="Meta describe about the post." rows="3"/>{{ old($form_data['meta_description']) }}</textarea>
	            </div>
	        </div>

	        <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['meta_keywords']}}" class="block text-black font-semibold">Enter {{ucfirst(str_replace('_', ' ', $form_data['meta_keywords']))}}</label>
	                <input name="{{$form_data['meta_keywords']}}" type="text" autofocus id="{{$form_data['meta_keywords']}}" value="{{ old($form_data['meta_keywords']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. ecommerce,success story,ecommerce success" />
	                <small class="text-sm">Note: Use comma separator to separate keywords</small>
	            </div>
			</div>


			{{--  
			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['quantity']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['quantity'])) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <input name="{{$form_data['quantity']}}" type="number" autofocus id="image" value="{{ old($form_data['quantity']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ ucfirst(str_replace('_', ' ', $form_data['quantity'])) }}" />
	                <span class="red-text" id="{{$form_data['quantity']}}-error" style=" color: red; "></span>
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['weight']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['weight'])) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <input name="{{$form_data['weight']}}" type="number" autofocus id="image" value="{{ old($form_data['weight']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ ucfirst(str_replace('_', ' ', $form_data['weight'])) }}" />
	                <span class="red-text" id="{{$form_data['weight']}}-error" style=" color: red; "></span>
	            </div>
			</div>

			@php $label = 'unit' @endphp
			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
	            <div class="my-2 text-sm">
	                <label for="{{$label}}" class="block text-black font-semibold">{{ __('Select') }} {{ ucfirst(str_replace('_', ' ', $label)) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <select name="{{$label}}" type="text" autofocus id="{{$label}}" value="{{$label}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" />
	                    <option value="">Select Unit</option>
	                    @foreach( $form_data['unit'] as $unit )
	                        <option value="{{$unit}}" {{ $unit == old($label) ? 'selected' : ''}}>{{$unit}}</option>
	                    @endforeach
	                </select>
	            </div>
	        </div>
	        --}}


			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['price']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['price'])) }}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <input name="{{$form_data['price']}}" type="number" autofocus id="image" value="{{ old($form_data['price']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ ucfirst(str_replace('_', ' ', $form_data['price'])) }}" />
	                <span class="red-text" id="{{$form_data['price']}}-error" style=" color: red; "></span>
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
	            <div class="my-2 text-sm">
	                <label for="{{$form_data['status']}}" class="block text-black font-semibold">{{ __('Select') }} {{ucfirst(str_replace('_', ' ', $form_data['status']))}}
	                	<span class="text-red-600" value="*">*</span>
	                </label>
	                <select name="{{$form_data['status']}}" type="text" autofocus id="{{$form_data['status']}}" value="{{ old($form_data['status']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" />
	                    <option value="">Select Status</option>
	                    <option value="active" {{ "active" == old($form_data['status']) ? 'selected' : ''}}>Active</option>
	                    <option value="inactive" {{ "inactive" == old($form_data['status']) ? 'selected' : ''}}>Inactive</option>
	                </select>
	            </div>
	        </div>

	    </div>

		<div class="lg:col-span-1 md:col-span-1 sm:col-span-2 col-span-2 bg-red">
            <div class="my-7 text-sm">
                <button type="submit" class="md:w-60 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 rounded">Post it</button>
            </div>
        </div>
		{{-- lg:col-span-2 md:col-span-2 sm:col-span-4 --}}

	</form>
</div>


<script>

	$(document).ready(function () {

		$('#title').blur(function()	{
			let slug = $('#title').val();

			$('#slug').val(slugify(slug, "-"));

			check_slug_in_db();
		})

		function slugify (text, separator = "-") {
		    return text
		        .toString()
		        .normalize('NFD')   // split an accented letter in the base letter and the acent
		        .replace(/[\u0300-\u036f]/g, '')   // remove all previously split accents
		        .toLowerCase()
		        .trim()
		        .replace(/[^a-z0-9 ]/g, '')   // remove all chars not letters, numbers and spaces (to be replaced)
		        .replace(/\s+/g, separator);
		};

		$('#slug').blur(function() {
			check_slug_in_db()
		})

		$('#code').blur(function() {
			check_code_in_db()
		})

		function check_slug_in_db() {
			$('#slug-error').text('');

			let _token   = $('meta[name="csrf-token"]').attr('content');
			var slug = $('#slug').val();
			$.ajax({
				url: "/slug-check",
				type:"POST",
				data:{
					slug:slug,
					_token: _token
				},
				success:function(response) {
					if(response) {
						$('#slug-error').text(response.error);
					}
				},
			});
		}

		function check_code_in_db() {
			$('#code-error').text('');

			let _token   = $('meta[name="csrf-token"]').attr('content');
			var code = $('#code').val();
			$.ajax({
				url: "/code-check",
				type:"POST",
				data:{
					code:code,
					_token: _token
				},
				success:function(response) {
					if(response) {
						$('#code-error').text(response.error);
					}
				},
			});
		}
	});

</script>

<script>
    CKEDITOR.replace( 'short_description' );
    CKEDITOR.replace( 'long_description' );
    CKEDITOR.replace( 'meta_description' );
</script>

{{-- background-color: #bd2130;
    border-color: #b21f2d; --}}
<script type="text/javascript">
    // add row
    $("#add-code-row").click(function () {
        var html = '';
        /*html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="remove-code-row" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#new-code-row').append(html);*/

        html += '<div id="inputFormRow">';
		html +=	'<div class="my-2 text-sm">';
	    html += '<input name="{{$form_data['codes']}}[]" type="number" autofocus id="{{$form_data['codes']}}" value="{{ old($form_data['codes']) }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="{{ ucfirst(str_replace('_', ' ', $form_data['codes'])) }}" />';
	    html += '<span id="remove-code-row" class="pt-1 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 cursor-pointer">Remove</span>';
	    html +='</div>';
		html +='</div>';

		$('#new-code-row').append(html);
    });

    // remove row
    $(document).on('click', '#remove-code-row', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>