@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <nav>
                <a href="{{route('home')}}">ホーム</a>
                <a href="{{route('purchase-history')}}">購入履歴</a>
                <a>購入手続き</a>
            </nav>

            <div class="card">
                <div class="card-header">
                    <p>ようこそ{{ Auth::user()->name }}さん</p>

                    <!-- 戻るボタン -->
                    <div class="header-right">
                        <a href="{{route('home')}}">ホームに戻る</a>
                    </div>
                </div>
                <!-- データベースに登録された商品を繰り返し表示する -->
                <form action="{{ route('item-purchase')}}" method="POST">
                    @csrf
                    <p class="purchase-header">カート内の商品</p>
                    
                    @foreach($cartInItems as $cartInItem)
                        <!-- カート内の商品を表示する -->
                        <div class="cartInItems">
                            <p class="cartInItems-name">{{$cartInItem->name}}</p>

                            <p><img src="{{Storage::url($cartInItem->file_path)}}"></p>

                            <p class="cartInItems-price"><span>{{$cartInItem->price}}</span>円(税込)</p>

                            <p>購入数:{{$cartInItem->count}}個</p>

                            <p class="cartInItem-totalAmount">合計:<span>{{$cartInItem->price * $cartInItem->count}}</span>円</p>
                            <!-- 合計金額を計算、更新する -->
                            <?php $totalAmount += $cartInItem->price * $cartInItem->count?>

                            <!-- カートから削除するボタン -->
                            <input type="hidden" name="id" value="{{$cartInItem->id}}">
                            <button type="submit" name="empty_button">削除</button>
                        </div>
                    @endforeach

                    @if(!($cartInItems->isEmpty())) 
                        <div class="purchase-button">
                            <!--  購入ボタン  -->
                            <p>合計金額:<span>{{$totalAmount}}</span>円</p>
                            <button type="submit" name="purchase_button">購入する</button>
                        </div>
                    @else
                        <p class="purchase-button">カート内に商品が入っていません</p>
                    @endif
                 </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
