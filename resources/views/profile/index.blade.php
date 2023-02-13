@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="list-profile col-md-12 mx-auto">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">登録日(date)</th>
                                <th width="10%">氏名(name)</th>
                                <th width="20%">性別(gender)</th>
                                <th width="20%">趣味(hobby)</th>
                                <th width="30%">自己紹介(introduction)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th>{{ $post->updated_at->format('Y年m月d日') }}</th>
                                    <td>{{ Str::limit($post->name, 100) }}</td>
                                    <td>{{ Str::limit($post->gender, 50) }}</td>
                                    <td>{{ Str::limit($post->hobby, 100) }}</td>
                                    <td>{{ Str::limit($post->introduction, 250) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection