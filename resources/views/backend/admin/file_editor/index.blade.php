@extends('layouts.admin')

@section('title', 'Quản lí mã nguồn')
@section('breadcrumb')
    {{ Breadcrumbs::render('file_editor.index') }}
@endsection

@section('content')

<table>
    <thead>
        <tr>
            <th>Tên File</th>
            <th>Đường Dẫn</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
            <tr>
                <td>{{ $file->getFilename() }}</td>
                <td>{{ $file->getRealPath() }}</td>
                <td>
                    <a href="{{ route('file_editor.edit', ['file' => base64_encode($file->getRealPath())]) }}">Sửa</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection