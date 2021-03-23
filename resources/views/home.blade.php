@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav>
                <a>ホーム</a>
                <a href="{{route('purchase-history')}}">購入履歴</a>
                <a href="{{route('item-cartClick')}}">購入手続き</a>
            </nav>

            <div class="card">
                <div class="card-header">
                    <p>ようこそ{{ Auth::user()->name }}さん</p>
                    <!-- ショッピングカートボタン -->
                    <div class="header-right">
                        <a href="{{route('item-cartClick')}}">
                            <!-- cartデータベースが空なら -->
                            @if($cartItem->isEmpty())
                            <p class="shopping-count">0</p>
                            @else
                            <!-- cartデータベースにデータが入っていたらデータの数だけ表示する -->
                            <p class="shopping-count">{{$cartItemCount}}</p>
                            @endif
                            <img src="images/Shopping_cart.png" alt="カートの画像">
                        </a>
                    </div>
                </div>

                <!-- データベースに登録された商品を繰り返し表示する -->
                @foreach($items as $item)
                    <!-- 在庫があるものだけ表示する -->
                    @if(!($item->stock == 0))
                    <div class="items">
                        <form action="{{ route('item-inCart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <p class="item-name">{{$item->name}}</p>
                            <input type="hidden" name="name" value="{{$item->name}}">

                            <p><img src="{{Storage::url($item->file_path)}}"></p>
                            <input type="hidden" name="path" value="{{$item->file_path}}">

                            <p class="item-price"><span>{{$item->price}}</span>円(税込)</p>
                            <input type="hidden" name="price" value="{{$item->price}}">

                            <p class="item-description">{{$item->description}}</p>

                            <div class="item-button">
                                <label>
                                    <p>個数</p>
                                    <select name="count">
                                        @for($i = 1; $i <= $item->stock; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </label><br>

                                <button type="submit">カートに入れる</button>
                            </div>
                        </form>
                        <?php $count++ ?>
                    </div>
                    @else
                        <!-- すべての在庫がない場合 -->
                        @if($count === 0)
                            <p class="notItems">現在購入できる商品がありません</p>
                        @endif    
                    @endif
                @endforeach
                
                @if($items->isEmpty())
                    <p class="notItems">現在購入できる商品がありません</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
