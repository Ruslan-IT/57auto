<x-app-layout>
    @section('meta')
        <meta name="robots" content="noindex, nofollow">
    @endsection
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-white">

        <!-- HEADER -->
        <x-slot name="header">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Dashboard
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Личный кабинет пользователя
                </p>
            </div>
        </x-slot>

        <!-- CONTENT -->
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-6">

                <!-- WELCOME CARD -->
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        👋 Добро пожаловать!
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Вы успешно вошли в систему. Здесь будет твоя статистика, задачи и активность.
                    </p>
                </div>

                <!-- CARDS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- CARD 1 -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <h4 class="text-gray-700 font-semibold">📌 Задачи</h4>
                        <p class="text-3xl font-bold text-blue-600 mt-2">12</p>
                        <p class="text-sm text-gray-400 mt-1">Активные задачи</p>
                    </div>

                    <!-- CARD 2 -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <h4 class="text-gray-700 font-semibold">⚡ Прогресс</h4>
                        <p class="text-3xl font-bold text-blue-600 mt-2">68%</p>
                        <p class="text-sm text-gray-400 mt-1">Общий прогресс</p>
                    </div>

                    <!-- CARD 3 -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <h4 class="text-gray-700 font-semibold">💳 Статус</h4>
                        <p class="text-3xl font-bold text-blue-600 mt-2">Free</p>
                        <p class="text-sm text-gray-400 mt-1">Текущий тариф</p>
                    </div>

                </div>

                <!-- BUTTON SECTION -->
                <div class="mt-8 flex gap-4">
                    <a href="/tasks"
                       class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Перейти к задачам
                    </a>

                    <a href="/profile"
                       class="px-5 py-3 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Профиль
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
