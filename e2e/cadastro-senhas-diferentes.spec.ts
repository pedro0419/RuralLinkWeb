import { test, expect } from '@playwright/test';

test('senhas que não coincidem', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', `teste_${Date.now()}@gmail.com`);
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'SenhaErrada@9999'); // ← diferente

  await page.click('button[type="submit"]');

  // Deve permanecer na página de cadastro
  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');

  // Deve exibir mensagem de erro
  await expect(page.locator('.text-red-500')).toBeVisible();
});

test('confirmação de senha vazia', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', `teste_${Date.now()}@gmail.com`);
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  // Deixa password_confirmation vazio

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});