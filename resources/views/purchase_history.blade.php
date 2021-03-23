@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav>
                <a href="{{route('home')}}">ホーム</a>
                <a>購入履歴</a>
                <a href="{{route('item-cartClick')}}">購入手続き</a>
            </nav>

            <div class="card">
                <div class="card-header">
                    <p>ようこそ{{ Auth::user()->name }}さん</p>
                </div>

                <p class="purchase-historyHeader">購入履歴</p>

                @foreach($purchaseHistoryItems as $purchaseHistoryItem)

                    <!-- ログイン中ユーザーのIDと購入時登録されたIDが一致したら表示 -->
                    @if($purchaseHistoryItem->buyer_id === Auth::user()->id)
                    <div class="purchase-historyItems">
                        <p class="purchase-history">{{$purchaseHistoryItem->name}}</p>
                        <p class="purchase-history"><img src="{{Storage::url($purchaseHistoryItem->file_path)}}"></p>
                        <p class="purchase-history">価格:{{$purchaseHistoryItem->price}}円</p>
                        <p class="purchase-history">購入数量:{{$purchaseHistoryItem->volume}}</p>
                        <p class="purchase-history">購入日:{{$purchaseHistoryItem->created_at}}</p>
                    </div>
                    @endif

                    <!-- 7件以上は表示しない -->
                    @if($counter > 6)
                        @break;
                    @endif

                    <?php $counter++ ?>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
