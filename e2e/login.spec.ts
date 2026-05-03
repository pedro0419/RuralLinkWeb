import { test, expect } from '@playwright/test';

test('login com credenciais válidas', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});

test('login com credenciais inválidas', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  await page.fill('input[name="email"]', 'errado@email.com');
  await page.fill('input[name="password"]', 'senhaerrada');

  await page.click('button[type="submit"]');

  await expect(page.locator('.text-red-400')).toBeVisible();
});