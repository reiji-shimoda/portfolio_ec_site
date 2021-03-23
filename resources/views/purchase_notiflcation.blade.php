@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <header id="admin-header">
                <a href="{{route('admin-showItems')}}">登録商品一覧</a>
                <a>購入通知</a>
                <a href="{{route('admin-index')}}">商品登録</a>
            </header>

            <div class="card">
                <div class="card-header">
                    <p>ようこそ{{Auth::guard('admin')->user()->name}}さん</p>
                </div>
                
                <div class="card-body">

                    <p class="purchase-historyHeader">購入通知</p>
                    
                    @foreach($items as $item)
                        <!-- 購入履歴のseller_idと一致したら -->
                        @if($item->seller_id === Auth::guard('admin')->user()->id)
                        <div class="items">
                            <p class="item-name">{{$item->name}}</p>

                            <p><img src="{{Storage::url($item->file_path)}}"></p>

                            <p class="item-price"><span>{{$item->price}}</span>円(税込)</p>

                            <!-- 購入者を表示-->
                            @foreach($users as $user)
                                @if($user->id === $item->buyer_id)
                                    <p>購入者:{{$user->name}}様</p>
                                @endif
                            @endforeach

                            <p>購入日:{{$item->created_at}}</p>

                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection