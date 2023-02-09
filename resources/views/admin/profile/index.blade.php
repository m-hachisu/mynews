@extends('layouts.admin')
@section('title', '登録済みプロフィールの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.profile.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.profile.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">氏名(name)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-profile col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">氏名(name)</th>
                                <th width="20%">性別(gender)</th>
                                <th width="20%">趣味(hobby)</th>
                                <th width="20%">自己紹介(introduction)</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $profiles)
                                <tr>
                                    <th>{{ $profiles->id }}</th>
                                    <td>{{ Str::limit($profiles->name, 100) }}</td>
                                    <td>{{ Str::limit($profiles->gender, 50) }}</td>
                                    <td>{{ Str::limit($profiles->hobby, 100) }}</td>
                                    <td>{{ Str::limit($profiles->introduction, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.profile.edit', ['id' => $profiles->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.profile.delete', ['id' => $profiles->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection