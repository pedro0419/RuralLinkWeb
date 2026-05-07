import { defineConfig, devices } from '@playwright/test';

export default defineConfig({
  testDir: './e2e',
  fullyParallel: false,
  forbidOnly: false,
  retries: 1,
  workers: 1,
  timeout: 30000,
  reporter: 'html',
  use: {
    baseURL: process.env.APP_URL || 'http://127.0.0.1:8000',
    trace: 'on-first-retry',
    ignoreHTTPSErrors: true,
  },

  // Só inicia o servidor local se não tiver APP_URL definido
  webServer: process.env.APP_URL ? undefined : {
    command: 'php artisan serve',
    url: 'http://127.0.0.1:8000',
    reuseExistingServer: true,
    timeout: 120 * 1000,
  },

  projects: [
    {
      name: 'chromium',
      use: { 
        ...devices['Desktop Chrome'],
        launchOptions: {
          args: ['--ignore-certificate-errors']
        }
      },
    },
  ],
});

// $env:APP_URL="https://ruralink.free.laravel.cloud"; npx playwright test --ui