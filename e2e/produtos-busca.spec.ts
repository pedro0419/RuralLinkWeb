import { test, expect } from '@playwright/test';

test.beforeEach(async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});

test('busca por produto existente', async ({ page }) => {
  await page.fill('input[name="search"]', 'Banana');
  await page.press('input[name="search"]', 'Enter');

  await expect(page.locator('.product-card').first()).toBeVisible();
});

test('busca por produto inexistente', async ({ page }) => {
  await page.fill('input[name="search"]', 'produtoquenaoexiste123');
  await page.press('input[name="search"]', 'Enter');

  await expect(page.locator('text=Nenhum produto encontrado.')).toBeVisible();
});

test('busca por nome de produtor', async ({ page }) => {
  await page.fill('input[name="search"]', 'pedro');
  await page.press('input[name="search"]', 'Enter');

  await expect(page.locator('.product-card').first()).toBeVisible();
});

test('busca com campo vazio retorna todos os produtos', async ({ page }) => {
  await page.fill('input[name="search"]', '');
  await page.press('input[name="search"]', 'Enter');

  await expect(page.locator('.product-card').first()).toBeVisible();
});