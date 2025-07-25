<x-filament-panels::page>
    <div class="space-y-6">
        
        <!-- Email Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            @php($stats = $this->getEmailStats())
            
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <x-heroicon-o-users class="w-6 h-6 text-blue-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Verified Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['verified_users'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <x-heroicon-o-exclamation-circle class="w-6 h-6 text-yellow-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Unverified Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['unverified_users'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <x-heroicon-o-shield-check class="w-6 h-6 text-purple-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Admin Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['admin_users'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <x-heroicon-o-user class="w-6 h-6 text-indigo-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Regular Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['regular_users'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Management Form -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Send Emails to Users</h2>
                <p class="text-sm text-gray-600 mt-1">Select a user and choose from the available email actions.</p>
            </div>

            {{ $this->form }}
        </div>

        <!-- Email Templates Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center mb-4">
                    <x-heroicon-o-paper-airplane class="w-5 h-5 text-green-600 mr-2" />
                    <h3 class="text-lg font-semibold text-gray-900">Welcome Email</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Send a professional welcome email to new users with company branding and next steps information.
                </p>
                <div class="text-xs text-gray-500">
                    <strong>Includes:</strong> Company logo, welcome message, next steps, contact information
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center mb-4">
                    <x-heroicon-o-key class="w-5 h-5 text-orange-600 mr-2" />
                    <h3 class="text-lg font-semibold text-gray-900">Password Reset</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Generate a secure random password and send it to users via email with login instructions.
                </p>
                <div class="text-xs text-gray-500">
                    <strong>Includes:</strong> Auto-generated secure password, login link, security tips
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center mb-4">
                    <x-heroicon-o-receipt-percent class="w-5 h-5 text-blue-600 mr-2" />
                    <h3 class="text-lg font-semibold text-gray-900">Payment Success</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Automatically sent after successful payments with detailed receipt and package information.
                </p>
                <div class="text-xs text-gray-500">
                    <strong>Includes:</strong> Payment details, PDF receipt, package features, next steps
                </div>
            </div>
        </div>

        <!-- Queue Status -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Email Queue Information</h3>
                <p class="text-sm text-gray-600">All emails are processed through a queue system for better performance.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-medium text-blue-900">Queue Driver</h4>
                    <p class="text-sm text-blue-700">{{ config('queue.default') }}</p>
                </div>
                
                <div class="p-4 bg-green-50 rounded-lg">
                    <h4 class="font-medium text-green-900">Mail Driver</h4>
                    <p class="text-sm text-green-700">{{ config('mail.default') }}</p>
                </div>
            </div>
        </div>

    </div>
</x-filament-panels::page>
