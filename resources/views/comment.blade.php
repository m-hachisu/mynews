@extends('layouts.front')
@section('title', 'ニュースの詳細')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ニュース詳細</h2>
                <div class="row">
                    <div class="posts col-md-8 mx-auto mt-3">
                            <div class="post">
                                <div class="row">
                                    <div class="text col-md-6">
                                        <div class="date">
                                            {{ $news_form->updated_at->format('Y年m月d日') }}
                                        </div>
                                        <div class="title">
                                            {{ $news_form->title }}
                                        </div>
                                        <div class="body mt-3">
                                            {{ $news_form->body }}
                                        </div>
                                    </div>
                                    <div class="image col-md-6 text-right mt-4">
                                        @if ($news_form->image_path)
                                            <img src="{{ secure_asset('storage/image/' . $news_form->image_path) }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr color="#c0c0c0">
                    </div>
                    <div class="text col-md-4">
                        <a href="{{ route('news.index') }}">一覧へ戻る</a>
                    </div>
                </div>
                {{-- コメントを画面で参照できるように追記 --}}
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>コメント一覧</h2>
                        <ul class="list-group">
                            @if ($news_form->comments != NULL)
                                @foreach ($news_form->comments as $comment)
                                    <li class="list-group-item">{{ $comment->comment }}</li>
                                    <a href="{{ route('comment.delete', ['id' => $comment->id]) }}">削除</a>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <form action="{{ route('comment.create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">コメント</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="comment" rows="5">{{ old('comment') }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="news_id" value="{{ $news_form->id }}">
                    @csrf
                    <input type="submit" class="btn btn-primary" value="書き込む">
                </form>
            </div>
        </div>
    </div>
@endsection