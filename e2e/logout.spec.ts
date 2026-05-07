import { test, expect } from '@playwright/test';

test('logout com sucesso', async ({ page }) => {
  // 1. Faz login primeiro
  await page.goto('https://ruralink.free.laravel.cloud/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('https://ruralink.free.laravel.cloud/TelaInicial');

  // 2. Vai para o perfil onde fica o botão de logout
  await page.goto('https://ruralink.free.laravel.cloud/perfil');

  // 3. Clica em "Encerrar sessão"
  await page.click('button.btn-red');

  // 4. Verifica se voltou para a página de login
  await expect(page).toHaveURL('https://ruralink.free.laravel.cloud/login');
});

test('usuário deslogado não acessa área restrita', async ({ page }) => {
  // Tenta acessar o perfil sem estar logado
  await page.goto('https://ruralink.free.laravel.cloud/perfil');

  // Deve redirecionar para o login
  await expect(page).toHaveURL('https://ruralink.free.laravel.cloud/login');
});