@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản Lý Danh Mục') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($category))
                            {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên danh mục', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên danh mục',
                                'id' => 'title',
                                'onkeyup' => 'ChangeToSlug()'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập slug',
                                'id' => 'slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', [
                                'style' => 'resize:none;',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mô tả',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($category) ? $category->status : '', ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit(isset($category) ? 'Sửa danh mục': 'Thêm danh mục', ['class' => 'btn btn-success mt-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="order_position">
                        @foreach ($categories as $key => $category)
                            <tr id="{{ $category->id }}">
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    @if ($category->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['categories.destroy', $category->id],
                                        'onsubmit' => 'return confirm("Bạn chắc chắn muốn xóa?")'
                                        ])
                                    !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
