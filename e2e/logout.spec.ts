import { test, expect } from '@playwright/test';

test('logout com sucesso', async ({ page }) => {
  // 1. Faz login primeiro
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');

  // 2. Vai para o perfil onde fica o botão de logout
  await page.goto('http://127.0.0.1:8000/perfil');

  // 3. Clica em "Encerrar sessão"
  await page.click('button.btn-red');

  // 4. Verifica se voltou para a página de login
  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});

test('usuário deslogado não acessa área restrita', async ({ page }) => {
  // Tenta acessar o perfil sem estar logado
  await page.goto('http://127.0.0.1:8000/perfil');

  // Deve redirecionar para o login
  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});