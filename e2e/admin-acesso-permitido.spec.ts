import { test, expect } from '@playwright/test';

test.beforeEach(async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'pedro19@gmail.com');
  await page.fill('input[name="password"]', '123456');
  await page.click('button[type="submit"]');
  await page.waitForLoadState('networkidle');
});

test('admin acessa o dashboard', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/admin/dashboard', { waitUntil: 'domcontentloaded' });

  await expect(page).toHaveURL('http://127.0.0.1:8000/admin/dashboard');
  await expect(page.locator('.admin-badge')).toBeVisible();
});

test('admin acessa lista de usuários', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/admin/usuarios', { waitUntil: 'domcontentloaded' });

  await expect(page).toHaveURL('http://127.0.0.1:8000/admin/usuarios');
  await expect(page.locator('.admin-badge')).toBeVisible();
});

test('admin acessa lista de postagens', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/admin/postagens', { waitUntil: 'domcontentloaded' });

  await expect(page).toHaveURL('http://127.0.0.1:8000/admin/postagens');
  await expect(page.locator('.admin-badge')).toBeVisible();
});

test('admin vê total de usuários no dashboard', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/admin/dashboard', { waitUntil: 'domcontentloaded' });

  await expect(page.locator('text=Total de Usuários')).toBeVisible();
  await expect(page.locator('text=Total de Postagens')).toBeVisible();
});

test('sidebar do admin está visível', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/admin/dashboard', { waitUntil: 'domcontentloaded' });

  await expect(page.locator('.sidebar')).toBeVisible();
  await expect(page.locator('text=Painel Admin')).toBeVisible();
});