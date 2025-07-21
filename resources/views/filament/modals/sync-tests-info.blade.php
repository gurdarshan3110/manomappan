<div class="space-y-4">
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                    About Test Synchronization
                </h3>
                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                    <p>Test synchronization connects to the external Mehrizm API to fetch the latest test data and update your local database.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-3">
        <div>
            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">API Details</h4>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                <li><strong>Endpoint:</strong> https://mehrizm.com/PARTNER/listTests</li>
                <li><strong>Method:</strong> POST</li>
                <li><strong>Partner ID:</strong> myskoolapp</li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">What Happens During Sync</h4>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1 list-disc list-inside">
                <li>Fetches all tests from the external API</li>
                <li>Creates new tests that don't exist locally</li>
                <li>Updates existing tests based on their external ID</li>
                <li>Preserves local data and relationships</li>
                <li>Only syncs activated tests for display</li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">Data Mapping</h4>
            <div class="bg-gray-50 dark:bg-gray-800 rounded p-3 text-xs">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-1">API Field</th>
                            <th class="text-left py-1">Local Field</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 dark:text-gray-400">
                        <tr><td>_id</td><td>external_id</td></tr>
                        <tr><td>name</td><td>name</td></tr>
                        <tr><td>displayName</td><td>display_name</td></tr>
                        <tr><td>language</td><td>language</td></tr>
                        <tr><td>priceCounselor</td><td>price_counselor</td></tr>
                        <tr><td>priceCounselee</td><td>price_counselee</td></tr>
                        <tr><td>counterCounselor</td><td>counter_counselor</td></tr>
                        <tr><td>counterCounselee</td><td>counter_counselee</td></tr>
                        <tr><td>activated</td><td>activated</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                        Important Notes
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Synchronization may take 30-60 seconds to complete</li>
                            <li>SSL verification is disabled for development environments</li>
                            <li>Existing tests are never deleted, only created or updated</li>
                            <li>Package relationships are preserved during sync</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-2">
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Last documentation update: July 21, 2025
        </p>
    </div>
</div>
