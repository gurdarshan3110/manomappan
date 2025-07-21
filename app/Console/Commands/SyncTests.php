<?php

namespace App\Console\Commands;

use App\Models\Test;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:tests {--force : Force sync even if API fails} {--no-ssl : Disable SSL verification for development}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync tests from external API (mehrizm.com)';

    /**
     * API endpoint and credentials
     */
    private const API_URL = 'https://mehrizm.com/PARTNER/listTests';
    private const PARTNER_ID = 'myskoolapp';
    private const SECRET = 'T0r0nt02Ch@ndig@rh';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting test synchronization...');

        try {
            // Make API request
            $response = $this->makeApiRequest();
            
            if (!$response || !is_array($response)) {
                $this->error('Invalid response from API');
                return 1;
            }

            $this->info('Received ' . count($response) . ' tests from API');

            // Process each test
            $created = 0;
            $updated = 0;
            $errors = 0;

            $progressBar = $this->output->createProgressBar(count($response));
            $progressBar->start();

            foreach ($response as $testData) {
                try {
                    $result = $this->syncTest($testData);
                    if ($result === 'created') {
                        $created++;
                    } elseif ($result === 'updated') {
                        $updated++;
                    }
                } catch (\Exception $e) {
                    $errors++;
                    Log::error('Error syncing test: ' . $e->getMessage(), [
                        'test_data' => $testData,
                        'error' => $e->getTraceAsString()
                    ]);
                }
                $progressBar->advance();
            }

            $progressBar->finish();
            $this->newLine(2);

            // Display results
            $this->info("Synchronization completed!");
            $this->table(['Action', 'Count'], [
                ['Created', $created],
                ['Updated', $updated],
                ['Errors', $errors],
                ['Total Processed', count($response)]
            ]);

            return 0;

        } catch (\Exception $e) {
            $this->error('Error during synchronization: ' . $e->getMessage());
            Log::error('Test sync error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    /**
     * Make API request to fetch tests
     */
    private function makeApiRequest(): ?array
    {
        $this->info('Fetching tests from API...');

        try {
            $httpClient = Http::timeout(30);
            
            // Disable SSL verification if --no-ssl option is used (for development)
            if ($this->option('no-ssl')) {
                $this->warn('SSL verification disabled - use only in development!');
                $httpClient = $httpClient->withOptions(['verify' => false]);
            }

            $response = $httpClient->post(self::API_URL, [
                'partnerId' => self::PARTNER_ID,
                'secret' => self::SECRET
            ]);

            if (!$response->successful()) {
                $this->error('API request failed with status: ' . $response->status());
                $this->error('Response: ' . $response->body());
                return null;
            }

            $data = $response->json();
            
            if (!is_array($data)) {
                $this->error('API response is not an array');
                $this->error('Response type: ' . gettype($data));
                $this->error('Response content: ' . $response->body());
                return null;
            }

            return $data;

        } catch (\Exception $e) {
            $this->error('Failed to make API request: ' . $e->getMessage());
            if ($this->option('verbose')) {
                $this->error('Stack trace: ' . $e->getTraceAsString());
            }
            return null;
        }
    }

    /**
     * Sync a single test record
     */
    private function syncTest(array $testData): string
    {
        // Map API response fields to our database fields
        $mappedData = $this->mapTestData($testData);

        // Find existing test by external_id
        $existingTest = Test::where('external_id', $mappedData['external_id'])->first();

        if ($existingTest) {
            // Update existing test
            $existingTest->update($mappedData);
            return 'updated';
        } else {
            // Create new test
            Test::create($mappedData);
            return 'created';
        }
    }

    /**
     * Map API response data to our database structure
     */
    private function mapTestData(array $testData): array
    {
        return [
            'name' => $testData['name'] ?? '',
            'display_name' => trim($testData['displayName'] ?? ''),
            'language' => $testData['language'] ?? '',
            'price_counselor' => (int) ($testData['priceCounselor'] ?? 0),
            'price_counselee' => (int) ($testData['priceCounselee'] ?? 0),
            'counter_counselor' => (int) ($testData['counterCounselor'] ?? 0),
            'counter_counselee' => (int) ($testData['counterCounselee'] ?? 0),
            'activated' => (bool) ($testData['activated'] ?? true),
            'external_id' => $testData['_id'] ?? null,
        ];
    }
}
