import { test, expect } from '@playwright/test';

test('cadastro com email já existente', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  // Usa um email que já existe no banco
  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'Senha@1234');

  await page.click('button[type="submit"]');

  // Deve continuar na página de cadastro com erro
  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');

  // Verifica se aparece mensagem de erro
  await expect(page.locator('.text-red-500')).toBeVisible();
});