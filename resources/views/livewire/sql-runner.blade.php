<div>

    <div class="user-stats">
        <div>🏆 Rating: {{ $userRating }}</div>
        <div>🎯 Level: {{ $userLevel }}</div>

        @if($xpPopup)
            <div class="xp-popup">
                +{{ $xpValue }} XP
            </div>
        @endif
    </div>

    <div class="editor-wrapper" wire:ignore>
        <textarea id="sql-editor"></textarea>
    </div>


    <button wire:click="run"
            wire:loading.attr="disabled"
            class="btn-primary"
            id="run-btn">

    <span wire:loading.remove>
        ▶ Выполнить запрос
    </span>

        <span wire:loading>
        ⏳ Проверяю...
    </span>

    </button>



    @if($success)
        <div class="alert success">{{ $success }}</div>
    @endif

    @if($error)
        <div class="alert error">{{ $error }}</div>
    @endif

    @if($result)

        <div class="result-box">
            <h3>📊 Результат</h3>

            <table class="sql-table mt-3">
                <thead>
                <tr>
                    @foreach(array_keys((array)$result[0]) as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                </tr>
                </thead>

                <tbody>
                @foreach($result as $row)
                    <tr>
                        @foreach((array)$row as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {

            setTimeout(() => {

                const textarea = document.getElementById('sql-editor');

                if (!textarea) return;

                const editor = CodeMirror.fromTextArea(textarea, {
                    mode: 'text/x-sql',
                    theme: 'material',
                    lineNumbers: true,
                });

                editor.setSize("100%");

                const runBtn = document.getElementById('run-btn');

                runBtn.addEventListener('click', function () {
                @this.set('sql', editor.getValue());
                });

            }, 100);

        });
    </script>
@endpush
