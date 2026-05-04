import { test, expect } from '@playwright/test';

const emailUnico = `teste_${Date.now()}@gmail.com`;

test('cadastro com dados válidos', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar'); // ← corrigido

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', emailUnico);
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'Senha@1234');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});