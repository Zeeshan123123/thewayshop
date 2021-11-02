<div class="lg:px-16 md:px-8 sm:px-4 px-4 border-b border-gray-300 text-base">
	<form action="{{ route('blog.update') }}" method="POST">
		@csrf

		{{-- Start: Form hidden fields --}}

		{{-- End: Form hidden fields --}}


		<div class="grid grid-cols-4 gap-4 border-b border-gray-300 text-base">

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['title']}}" class="block text-black font-semibold">Enter {{ucfirst(str_replace('_', ' ', $form_data['title']))}}</label>
	                <input name="{{$form_data['title']}}" type="text" autofocus id="{{$form_data['title']}}" value="{{ $blog['title'] }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Ecommerce Success Story" />
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['slug']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['slug'])) }}</label>
	                <input name="{{$form_data['slug']}}" type="text" autofocus id="slug" value="{{ $blog['slug'] }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. build-a-website" />
	                <span class="red-text" id="{{$form_data['slug']}}-error" style=" color: red; "></span>
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['description']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['description'])) }}</label>
	                <textarea id="{{$form_data['description']}}" name="{{$form_data['description']}}" type="text" autofocus id="{{$form_data['description']}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="Describe about the post." rows="3"/>{{ $blog['description'] }}</textarea>
	            </div>
	        </div>

	        <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['meta_title']}}" class="block text-black font-semibold">Enter {{ucfirst(str_replace('_', ' ', $form_data['meta_title']))}}</label>
	                <input name="{{$form_data['meta_title']}}" type="text" autofocus id="{{$form_data['meta_title']}}" value="{{ $blog['meta_title'] }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. Ecommerce Success Story" />
	            </div>
			</div>

			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['meta_description']}}" class="block text-black font-semibold">Enter {{ ucfirst(str_replace('_', ' ', $form_data['meta_description'])) }}</label>
	                <textarea id="{{$form_data['meta_description']}}" name="{{$form_data['meta_description']}}" type="text" autofocus id="{{$form_data['meta_description']}}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="Meta describe about the post." rows="3"/>{{ $blog['meta_description'] }}</textarea>
	            </div>
	        </div>

	        <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$form_data['meta_keywords']}}" class="block text-black font-semibold">Enter {{ucfirst(str_replace('_', ' ', $form_data['meta_keywords']))}}</label>
	                <input name="{{$form_data['meta_keywords']}}" type="text" autofocus id="{{$form_data['meta_keywords']}}" value="{{ $blog['meta_keywords'] }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full" placeholder="e.g. ecommerce,success story,ecommerce success" />
	                <small class="text-sm">Note: Use comma separator to separate keywords</small>
	            </div>
			</div>

			@php $label = 'status'; @endphp
			<div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 bg-red">
				<div class="my-2 text-sm">
	                <label for="{{$label}}" class="block text-black font-semibold">Enter {{ucfirst(str_replace('_', ' ', $label))}}</label>
	                <select name="{{$label}}" type="text" autofocus id="{{$label}}" value="{{ $label }}" class="rounded-sm focus:outline-none text-sm bg-gray-100 w-full"/>
	                	<option value="active" {{($blog->status == 'active')?'selected':''}}>active</option>
	                	<option value="inactive" {{($blog->status == 'inactive')?'selected':''}}>inactive</option>
	                </select>
	                <small class="text-sm">Note: Use comma separator to separate keywords</small>
	            </div>
			</div>

		</div>

		{{-- Start: Input Hidden Fields --}}
			<input type="hidden" name="blog_id" value="{{Crypt::encrypt($blog->id)}}">
		{{-- End: Input Hidden Fields --}}

		<div class="lg:col-span-1 md:col-span-1 sm:col-span-2 col-span-2 bg-red">
            <div class="my-7 text-sm">
                <button type="submit" class="md:w-60 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 md:px-12 text-xs md:text-base lg:text-base mb-4 rounded">Update Blog</button>
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

		$('#slug').blur(function()	{
			check_slug_in_db()
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
					blog_id: '<?php echo($blog->id); ?>',
					_token: _token
				},
				success:function(response) {
					if(response) {
						$('#slug-error').text(response.error);
					}
				},
			});
		}
	});
</script>

<script>
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'meta_description' );
</script>
