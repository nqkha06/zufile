<form action="{{ route('file_editor.update') }}" method="POST">
    @csrf
    <input type="hidden" name="file_path" value="{{ $filePath }}">
    <textarea name="content" rows="20" cols="80">{{ $content }}</textarea>
    <button type="submit">Lưu</button>
</form>
