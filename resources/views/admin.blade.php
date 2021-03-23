@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <header id="admin-header">
                <a href="{{route('admin-showItems')}}">登録商品一覧</a>
                <a href="#">購入通知</a>
                <a>商品登録</a>
            </header>

            <div class="card">
                <div class="card-header">
                    <p>ようこそ{{Auth::guard('admin')->user()->name}}さん</p>
                    <div class="header-right">
                        <p>商品登録フォーム</p>
                    </div>
                </div>
                    

                <div class="card-body" id="admin-blade">

                    <p>下記項目をすべて入力してください</p>
                    <form method="POST" action="{{ route('admin-upload') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="seller_id" value="{{Auth::guard('admin')->user()->id}}">

                        <label>
                        <p>画像選択</p>
                        <input type="file" name="image" accept="image/png, image/jpeg"><br>
                        </label><br>
                        
                        <label>
                        <p>商品名</p>
                        <input type="text" name="name"><br>
                        </label><br>

                        <label>
                        <p>価格(税込)</p>
                        <input type="number" name="price"><br>
                        </label><br>

                        <label>
                        <p>商品説明文(255文字まで)</p>
                        <input type="text" name="description"><br>
                        </label><br>

                        <label>
                        <p>在庫数</p>
                        <input type="number" name="stock"><br>
                        </label><br>

                        <input class="admin-button" type="submit" value="登録">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection