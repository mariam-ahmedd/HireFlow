<x-layout>
    <div class="min-h-screen bg-hireflow-bg flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-10">

        <div
            class="w-full max-w-sm sm:max-w-md bg-hireflow-surface/60 backdrop-blur-md border border-hireflow-border rounded-xl sm:rounded-2xl shadow-xl p-5 sm:p-8">

            <h2 class="text-hireflow-text text-xl sm:text-2xl font-semibold mb-5 sm:mb-6 text-center">
                {{ __('account.login_title') }}
            </h2>

            <form method="POST" action="/login" class="space-y-3 sm:space-y-4">
                @csrf

                <x-input name="email" :placeholder="__('account.email_ph')" type="email"
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition" />

                <x-input name="password" :placeholder="__('account.password_ph')" type="password"
                    class="w-full bg-hireflow-surface-hover text-hireflow-text placeholder-hireflow-muted border border-hireflow-border rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base focus:outline-none focus:border-hireflow-primary focus:ring-2 focus:ring-hireflow-primary/20 transition" />

                <button type="submit"
                    class="w-full bg-hireflow-primary hover:bg-hireflow-primary-hover text-white font-medium rounded-lg py-2.5 sm:py-3 text-sm sm:text-base mt-2 transition">
                    {{ __('account.login') }}
                </button>

                <p class="text-hireflow-muted text-xs sm:text-sm text-center mt-4">
                    {{ __('account.no_account') }}
                    <a href="/register" class="text-hireflow-primary hover:text-hireflow-primary-hover">{{ __('account.signup_link') }}</a>
                </p>

            </form>
        </div>

    </div>
</x-layout>
