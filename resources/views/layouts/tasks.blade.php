@extends('layouts.main')


@section('content')

    <div class="tasks-layout">

        {{-- SIDEBAR --}}
        <aside
            class=" tasks-sidebar"
            id="sidebar"
            x-data="taskSidebar()"
            x-init="init()"
        >

            <h2 class="text-lg font-bold text-gray-800 mb-4">
                📘 Курс SQL
            </h2>

            @php
                $user = auth()->user();
            @endphp

            @foreach($topics as $topic)

                @php
                    $total = $topic->tasks->count();

                    $solved = collect($solvedTaskIds ?? [])
                        ->intersect($topic->tasks->pluck('id'))
                        ->count();

                    $isLockedTopic = $topic->slug !== 'basics' && (!$user || !$user->isPremiumActive());
                @endphp

                <div class="mb-3">

                    {{-- TOPIC HEADER --}}
                    <button
                        type="button"
                        data-topic="{{ $topic->id }}"
                        class="topic-toggle w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition"
                    >
                <span class="font-medium text-gray-700">
                    {{ $topic->title }}
                </span>

                        <span class="text-xs text-gray-400">
                    {{ $solved }}/{{ $total }}
                </span>
                    </button>

                    {{-- TASKS --}}
                    <div class="mt-1 space-y-1 hidden" id="topic-{{ $topic->id }}">

                        @foreach($topic->tasks as $t)

                            @php
                                $isActive = ($t->id == ($task->id ?? null));
                            @endphp

                            <a
                                href="{{ $isLockedTopic ? '/pricing' : '/tasks/' . $t->slug }}"

                                class="flex items-center justify-between px-3 py-2 rounded-lg text-sm transition
                            {{ $isActive ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}"
                            >

                                <div class="flex items-center gap-2">

                              <span class="status" x-text="isSolved({{ $t->id }}) ? '✔' : '○'">

		                        </span>

                                <span>
                                    {{ $t->title }}
                                </span>

                                </div>

                                @if($isLockedTopic)
                                    <span class="text-xs">🔒</span>
                                @endif

                            </a>

                        @endforeach

                    </div>
                </div>

            @endforeach

        </aside>

        <button class="sidebar-toggle" onclick="toggleSidebar()">
             Список задач
        </button>

        {{-- CONTENT --}}
        <main class="tasks-content">
            @yield('task-content')
        </main>

    </div>

@endsection

