<style>
    .closebtn {
        color: black;
    }

    .closebtn:hover {
        color: black;
    }
</style>


@if ($errors->any())
    <div class="alert  bg-red-100 border border-red-400 text-red-700 p-5 delay-500">
        <span class="closebtn ml-2 text-black-700 font-bold float-right text-2xl leading-5 cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Danger!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert  bg-green-100 border border-green-400 text-green-700 p-5 delay-500" >
        <span class="closebtn ml-2 text-black-700 font-bold float-right text-2xl leading-5 cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Congrats!</strong> {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert  bg-red-100 border border-red-400 text-green-700 p-5 delay-500" >
        <span class="closebtn ml-2 text-black-700 font-bold float-right text-2xl leading-5 cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Danger!</strong> {{ session()->get('error') }}
    </div>
@endif
