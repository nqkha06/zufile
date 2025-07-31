@extends('layouts.admin')


@section('content')
<div class="container py-4">
    <h2 class="mb-4">Fingerprint Logs</h2>
    <table class="table table-bordered table-hover table-sm">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>User Agent</th>
                <th>Platform</th>
                <th>Lang</th>
                <th>Interaction</th>
                <th>Bot?</th>
                <th>Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($fingerprints as $fp)
                <tr>
                    <td>{{ $fp->id }}</td>
                    <td>{{ \Str::limit($fp->ua, 30) }}</td>
                    <td>{{ $fp->platform }}</td>
                    <td>{{ $fp->lang }}</td>
                    <td>{{ $fp->interaction_quality }}</td>
                    <td>
                        @if(optional($fp->automationFlags)->headless || optional($fp->automationFlags)->webdriver)
                            <span class="badge bg-danger">🤖 BOT</span>
                        @else
                            <span class="badge bg-success">✅ Real</span>
                        @endif
                    </td>
                    <td>{{ $fp->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('admin.fingerprints.show', $fp->id) }}" class="btn btn-sm btn-primary">Chi tiết</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $fingerprints->links() }}
</div>
@endsection
