@extends('layouts.admin')

@section('title', 'Drive Manager')

@section('content')

    <form method="GET" action="{{ route('admin.drive.index') }}" class="mb-4 grid grid-cols-1 md:grid-cols-7 gap-3">
        <select name="type" class="border rounded px-3 py-2">
            <option value="all" {{ request('type', 'all') === 'all' ? 'selected' : '' }}>All</option>
            <option value="folders" {{ request('type') === 'folders' ? 'selected' : '' }}>Folders</option>
            <option value="files" {{ request('type') === 'files' ? 'selected' : '' }}>Files</option>
        </select>
        <input type="text" name="name" value="{{ request('name') }}" placeholder="Search name"
            class="border rounded px-3 py-2">
        <input type="text" name="dir" value="{{ request('dir') }}" placeholder="dir (root or alias)"
            class="border rounded px-3 py-2">
        <input type="number" name="user" value="{{ request('user') }}" placeholder="User ID"
            class="border rounded px-3 py-2">
        <select name="per_page" class="border rounded px-3 py-2">
            @foreach ([20, 50, 100, 200] as $n)
                <option value="{{ $n }}" {{ (int) request('per_page', 50) === $n ? 'selected' : '' }}>
                    {{ $n }}/page</option>
            @endforeach
        </select>
        <label class="inline-flex items-center space-x-2">
            <input type="checkbox" name="trash" value="1" {{ request('trash') ? 'checked' : '' }}>
            <span>Trash</span>
        </label>
        <label class="inline-flex items-center space-x-2">
            <input type="checkbox" name="count_nest" value="1" {{ request('count_nest') ? 'checked' : '' }}
                {{ request('type', 'all') === 'files' ? 'disabled' : '' }}>
            <span>Count children</span>
        </label>
        <div class="md:col-span-7">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            <a href="{{ route('admin.drive.index') }}" class="ml-2 text-gray-600">Reset</a>
        </div>
    </form>

    @if (!empty($user) && $selectedUser)
        <div class="mb-4 text-sm text-gray-700">
            Filtering by user: <strong>{{ $selectedUser->name }}</strong> (ID: {{ $selectedUser->id }},
            {{ $selectedUser->email }})
        </div>
    @elseif(!empty($user))
        <div class="mb-4 text-sm text-gray-700">
            Filtering by user ID: <strong>{{ $user }}</strong>
        </div>
    @endif

    @php $currentType = $type ?? request('type','all'); @endphp

    @if ($currentType === 'files')
        {{-- Files only --}}
        <div class="bg-white border rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-3 py-2">Name</th>
                        <th class="text-left px-3 py-2">Original</th>
                        <th class="text-left px-3 py-2">Folder</th>
                        <th class="text-left px-3 py-2">Owner</th>
                        <th class="text-left px-3 py-2">Size</th>
                        <th class="text-left px-3 py-2">Mime</th>
                        <th class="text-left px-3 py-2">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($files as $file)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $file->name }}</td>
                            <td class="px-3 py-2">{{ $file->name_original }}</td>
                            <td class="px-3 py-2">{{ optional($file->folder)->name ?? '—' }}</td>
                            <td class="px-3 py-2">{{ optional($file->user)->name }} @if ($file->user)
                                    (ID: {{ $file->user->id }})
                                @endif
                            </td>
                            <td class="px-3 py-2">{{ number_format($file->size ?? 0) }} B</td>
                            <td class="px-3 py-2">{{ $file->mime_type }}</td>
                            <td class="px-3 py-2 text-gray-600">{{ $file->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-6 text-center text-gray-500">No files found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $files->appends(request()->query())->links() }}
        </div>
    @elseif($currentType === 'folders')
        {{-- Folders only --}}
        <div class="bg-white border rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-3 py-2">Name</th>
                        <th class="text-left px-3 py-2">Alias</th>
                        <th class="text-left px-3 py-2">Parent</th>
                        <th class="text-left px-3 py-2">Owner</th>
                        <th class="text-left px-3 py-2">Children</th>
                        <th class="text-left px-3 py-2">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($folders as $f)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $f->name }}</td>
                            <td class="px-3 py-2">{{ $f->alias }}</td>
                            <td class="px-3 py-2">{{ optional($f->parent)->name ?? '—' }}</td>
                            <td class="px-3 py-2">
                                @if ($f->user)
                                    {{ $f->user->name }} (ID: {{ $f->user->id }})
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-3 py-2">
                                @if (isset($f->children_count))
                                    {{ $f->children_count }}
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-3 py-2 text-gray-600">{{ $f->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-6 text-center text-gray-500">No folders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $folders->appends(request()->query())->links() }}
        </div>
    @else
        {{-- All: show both folders and files of the same level --}}
        <div class="row">
            <div class="col col-12">
                <h2 class="font-semibold mb-2">Folders</h2>
                <div class="bg-white border rounded">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left px-3 py-2">Name</th>
                                <th class="text-left px-3 py-2">Alias</th>
                                <th class="text-left px-3 py-2">Parent</th>
                                <th class="text-left px-3 py-2">Owner</th>
                                <th class="text-left px-3 py-2">Children</th>
                                <th class="text-left px-3 py-2">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($folders as $f)
                                <tr class="border-t">
                                    <td class="px-3 py-2">{{ $f->name }}</td>
                                    <td class="px-3 py-2">{{ $f->alias }}</td>
                                    <td class="px-3 py-2">{{ optional($f->parent)->name ?? '—' }}</td>
                                    <td class="px-3 py-2">{{ optional($f->user)->name }} @if ($f->user)
                                            (ID: {{ $f->user->id }})
                                        @endif
                                    </td>
                                    <td class="px-3 py-2">
                                        @if (isset($f->children_count))
                                            {{ $f->children_count }}
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 text-gray-600">{{ $f->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-6 text-center text-gray-500">No folders found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">{{ $folders?->appends(request()->query())->links('pagination.tabler') }}</div>
            </div>
            <div class="col col-12">
                <h2 class="font-semibold mb-2">Files</h2>
                <div class="bg-white border rounded table-responsive">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left px-3 py-2">Name</th>
                                <th class="text-left px-3 py-2">Original</th>
                                <th class="text-left px-3 py-2">Folder</th>
                                <th class="text-left px-3 py-2">Owner</th>
                                <th class="text-left px-3 py-2">Size</th>
                                <th class="text-left px-3 py-2">Mime</th>
                                <th class="text-left px-3 py-2">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($files as $file)
                                <tr class="border-t">
                                    <td class="px-3 py-2">{{ $file->name }}</td>
                                    <td class="px-3 py-2">{{ $file->name_original }}</td>
                                    <td class="px-3 py-2">{{ optional($file->folder)->name ?? '—' }}</td>
                                    <td class="px-3 py-2">{{ optional($file->user)->name }} @if ($file->user)
                                            (ID: {{ $file->user->id }})
                                        @endif
                                    </td>
                                    <td class="px-3 py-2">{{ number_format($file->size ?? 0) }} B</td>
                                    <td class="px-3 py-2">{{ $file->mime_type }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $file->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-3 py-6 text-center text-gray-500">No files found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">{{ $files?->appends(request()->query())->links('pagination.tabler') }}</div>
            </div>
        </div>
    @endif
@endsection
