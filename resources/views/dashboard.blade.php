<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1>User Logged-in !!!!</h1>
            {{ __('Dashboard') }}


        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('user_type') == 1)
                        <h1 style="color: red">{{ __("You're logged in as having a cycle!") }}</h1>
                    @endif
                        @if(session('user_type') == 0)
                        <h1 style="color: red">{{ __("You're logged in as not having a cycle!") }}</h1>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
