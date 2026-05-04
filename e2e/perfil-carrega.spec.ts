import { test, expect } from '@playwright/test';

test.beforeEach(async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});

test('página de perfil carrega corretamente', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil');
});

test('exibe nome do usuário', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page.locator('text=Antônio')).toBeVisible();
});

test('exibe botão encerrar sessão', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page.locator('button.btn-red')).toBeVisible();
});

test('exibe botão editar perfil', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page.locator('a.btn-green')).toBeVisible();
});

test('exibe seção meus produtos', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page.locator('text=Meus Produtos')).toBeVisible();
});

test('exibe botão adicionar produto', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page.locator('a.btn-add')).toBeVisible();
});

test('navegação inferior está visível', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil');

  await expect(page.locator('nav.nav-bottom')).toBeVisible();
});