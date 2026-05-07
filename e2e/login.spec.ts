import { test, expect } from '@playwright/test';

test('login com credenciais válidas', async ({ page }) => {
  await page.goto('https://ruralink.free.laravel.cloud/login');

  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('https://ruralink.free.laravel.cloud/TelaInicial');
});

test('login com credenciais inválidas', async ({ page }) => {
  await page.goto('https://ruralink.free.laravel.cloud/login');

  await page.fill('input[name="email"]', 'errado@email.com');
  await page.fill('input[name="password"]', 'senhaerrada');

  await page.click('button[type="submit"]');

  await expect(page.locator('.text-red-400')).toBeVisible();
});