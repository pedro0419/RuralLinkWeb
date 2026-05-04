import { test, expect } from '@playwright/test';

test('usuário comum não acessa o painel admin', async ({ page }) => {
  // Faz login como usuário comum
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');

  // Tenta acessar o painel admin
  await page.goto('http://127.0.0.1:8000/admin/dashboard');

  // Deve retornar 403
  await expect(page.locator('body')).toContainText('403');
});

test('usuário comum não acessa lista de usuários', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  await page.goto('http://127.0.0.1:8000/admin/usuarios');
  await expect(page.locator('body')).toContainText('403');
});

test('usuário comum não acessa lista de postagens admin', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  await page.goto('http://127.0.0.1:8000/admin/postagens');
  await expect(page.locator('body')).toContainText('403');
});

test('usuário deslogado não acessa o painel admin', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/admin/dashboard');

  // Deve redirecionar para o login
  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});