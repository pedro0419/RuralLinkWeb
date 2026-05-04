import { test, expect } from '@playwright/test';

test('campos vazios - email e senha', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  // Clica sem preencher nada
  await page.click('button[type="submit"]');

  // Deve continuar na página de login
  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});

test('campo email vazio', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  // Preenche só a senha
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  // Deve continuar na página de login
  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});

test('campo senha vazio', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  // Preenche só o email
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.click('button[type="submit"]');

  // Deve continuar na página de login
  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});