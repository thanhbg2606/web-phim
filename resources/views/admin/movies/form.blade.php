@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('movies.index') }}" class="btn btn-primary">Liệt kê phim</a>
                    <div class="card-header">{{ __('Quản Lý Phim') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($movie))
                            {!! Form::open(['route' => 'movies.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route' => ['movies.update', $movie->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên phim', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên phim',
                                'id' => 'title',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập slug',
                                'id' => 'slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', 'Danh mục', []) !!}
                            {!! Form::select('category_id', $categories, isset($movie) ? $movie->category_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('genre', 'Thể loại', []) !!}
                            {!! Form::select('genre_id', $genres, isset($movie) ? $movie->genre_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $countries, isset($movie) ? $movie->country_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Hình Ảnh', []) !!}
                            {!! Form::file('image', [
                                'class' => 'form-control',
                            ]) !!}
                            @if (isset($movie))
                                <img width="60%" src="{{ asset('uploads/movies/' . $movie->image) }}">
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                'style' => 'resize:none;',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mô tả',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($movie) ? $movie->status : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        {!! Form::submit(isset($movie) ? 'Sửa phim' : 'Thêm phim', ['class' => 'btn btn-success mt-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
