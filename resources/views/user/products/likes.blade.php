@extends('layouts.shop')

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-20">
            <div class="container">
                <section class="wishlist-area ptb-30">
                    <div class="container">
                        <div class="wishlist-wrapper">
                            <h3 class="h-title mb-40 t-uppercase">我的收藏列表</h3>
                            <table id="cart_list" class="wishlist">
                                <tbody>
                                @foreach ($likesProducts as $product)
                                    <tr class="panel alert">
                                    <td class="col-sm-8 col-md-9">
                                        <div class="media-left is-hidden-sm-down">
                                            <figure class="product-thumb">
                                                <img src="{{ $product->thumb }}" alt="{{ $product->name }}">
                                            </figure>
                                        </div>
                                        <div class="media-body valign-middle">
                                            <h5 class="title mb-5 t-uppercase"><a href="/products/{{ $product->uuid }}">{{ $product->name }}</a></h5>
                                            <div class="rating mb-10">
                                                <span class="rating-reviews">
				                        		( <span class="rating-count">{{ $product->users_count }}</span> 收藏 )</span>
                                            </div>
                                            <h4 class="price color-green"><span class="price-sale">￥{{ $product->original_price }}</span>￥{{ $product->price }}</h4>
                                        </div>
                                    </td>
                                    <td class="col-sm-1">
                                        <button type="button" class="close pr-xs-0 pr-sm-10" data-id="{{ $product->uuid }}" class="de_likes_btn">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                {{ $likesProducts->links() }}
            </div>
        </div>


    </main>
@endsection

@section('script')
    <script src="/assets/user/layer/2.4/layer.js"></script>
    <script>

        let _url = "/user/likes/";
        let token = "{{ csrf_token() }}";

        $('.de_likes_btn').click(function(){
            let that = $(this);
            let product_id = $(this).data('id');
            let url = _url + product_id;

            $.post(url, {_token:token,_method:'DELETE'}, function(res){
                layer.msg(res.msg);

                if (res.code == 301) {
                    return;
                }

                that.parent().parent().remove();
            });
        });
    </script>
@endsection
