@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-3xl font-black text-gray-900 mb-2 tracking-tight">Account Settings</h1>
            <p class="text-gray-500 font-medium">Manage your boutique account and security preferences.</p>
        </div>

        <div class="space-y-12">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    @livewire('profile.update-profile-information-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="bg-rose-50 rounded-[2.5rem] p-8 border border-rose-100">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
