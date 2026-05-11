import { test, expect } from '@playwright/test';

const BASE = process.env.APP_URL || 'http://127.0.0.1:8000';

test.beforeEach(async ({ page }) => {
  await page.goto('/login');

  await page.fill('input[name="email"]', 'pedro19@gmail.com');
  await page.fill('input[name="password"]', '123456');

  await Promise.all([
    page.waitForURL('**/admin/**'),
    page.click('button[type="submit"]')
  ]);
});

test('admin acessa o dashboard', async ({ page }) => {
  await page.goto('/admin/dashboard');

  await expect(page).toHaveURL(`${BASE}/admin/dashboard`);
  await expect(page.locator('.admin-badge')).toBeVisible();
});

test('admin acessa lista de usuários', async ({ page }) => {
  await page.goto('/admin/usuarios');

  await expect(page).toHaveURL(`${BASE}/admin/usuarios`);
  await expect(page.locator('.admin-badge')).toBeVisible();
});

test('admin acessa lista de postagens', async ({ page }) => {
  await page.goto('/admin/postagens');

  await expect(page).toHaveURL(`${BASE}/admin/postagens`);
  await expect(page.locator('.admin-badge')).toBeVisible();
});

test('admin vê total de usuários no dashboard', async ({ page }) => {
  await page.goto('/admin/dashboard');

  await expect(page.locator('text=Total de Usuários')).toBeVisible();
  await expect(page.locator('text=Total de Postagens')).toBeVisible();
});

test('sidebar do admin está visível', async ({ page }) => {
  await page.goto('/admin/dashboard');

  await expect(page.locator('.sidebar')).toBeVisible();
  await expect(page.locator('text=Painel Admin')).toBeVisible();
});