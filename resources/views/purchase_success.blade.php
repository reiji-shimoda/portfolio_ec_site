@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>購入が完了しました(※テスト)</p>
                    <a href="{{ route('home') }}">ホーム画面に戻る</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection