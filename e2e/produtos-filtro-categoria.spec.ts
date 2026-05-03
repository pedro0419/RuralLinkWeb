import { test, expect } from '@playwright/test';

test.beforeEach(async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});

test('filtro por Autônomos', async ({ page }) => {
  await page.click('a[href*="selo=autonomo"]');

  await expect(page).toHaveURL(/selo=autonomo/);
  await expect(page.locator('.product-card').first()).toBeVisible();
});

test('filtro por Cooperativas', async ({ page }) => {
  await page.click('a[href*="selo=cooperativa"]');

  await expect(page).toHaveURL(/selo=cooperativa/);
  await expect(page.locator('.product-card').first()).toBeVisible();
});

test('filtro por Orgânicos', async ({ page }) => {
  await page.click('a[href*="selo=organico"]');

  await expect(page).toHaveURL(/selo=organico/);

  // Pode não ter produtos orgânicos, então verifica um dos dois
  const temProdutos = await page.locator('.product-card').count();
  if (temProdutos > 0) {
    await expect(page.locator('.product-card').first()).toBeVisible();
  } else {
    await expect(page.locator('text=Nenhum produto encontrado.')).toBeVisible();
  }
});

test('filtro por Empresas', async ({ page }) => {
  await page.click('a[href*="selo=empresa"]');

  await expect(page).toHaveURL(/selo=empresa/);

  const temProdutos = await page.locator('.product-card').count();
  if (temProdutos > 0) {
    await expect(page.locator('.product-card').first()).toBeVisible();
  } else {
    await expect(page.locator('text=Nenhum produto encontrado.')).toBeVisible();
  }
});