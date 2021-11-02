<ul class="cart-list">
    @foreach( \Cart::getContent() as $product )
    <li>
        <a href="#" class="photo"><img src="{{ getImage($product->attributes->image) }}" class="cart-thumb" alt="" /></a>
        <h6><a href="#"> {{ $product->name }} </a></h6>
        <p>1x - <span class="price">{{ $product->price }}</span></p>
    </li>
    @endforeach
    <li class="total">
        <a href="{{ route('cart.view') }}" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
        <span class="float-right"><strong>Total</strong>: ${{ number_format(\Cart::getTotal()) }}</span>
    </li>
</ul>