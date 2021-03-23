@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <header id="admin-header">
                <a>登録商品一覧</a>
                <a href="{{route('admin-notiflcation')}}">購入通知</a>
                <a href="{{route('admin-index')}}">商品登録</a>
            </header>

            <div class="card">
                <div class="card-header">
                    <p>ようこそ{{Auth::guard('admin')->user()->name}}さん</p>
                </div>
                
                <div class="card-body">

                    <p class="purchase-historyHeader">登録商品一覧</p>

                    @foreach($items as $item)

                        @if($item->seller_id === Auth::guard('admin')->user()->id)
                        <div class="items">
                                <p class="item-name">{{$item->name}}</p>

                                <p><img src="{{Storage::url($item->file_path)}}"></p>

                                <p class="item-price"><span>{{$item->price}}</span>円(税込)</p>

                                <p class="item-description">{{$item->description}}</p>

                                <p>在庫数:{{$item->stock}}</p>
                                @if($item->stock === 0)
                                    <p class="outOfStock">在庫がありません</p>
                                @endif
                        </div>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection