import { test, expect } from '@playwright/test';

test.beforeEach(async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});

test('página de edição carrega corretamente', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil/editar');
  await expect(page.locator('input[name="name"]')).toBeVisible();
  await expect(page.locator('input[name="phone"]')).toBeVisible();
  await expect(page.locator('input[name="location"]')).toBeVisible();
  await expect(page.locator('textarea[name="description"]')).toBeVisible();
});

test('campos vêm preenchidos com dados atuais', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  const nome = await page.inputValue('input[name="name"]');
  expect(nome.length).toBeGreaterThan(0);
});

test('editar nome com sucesso', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  await page.fill('input[name="name"]', 'Antônio Editado');
  await page.click('button.btn-green');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil/editar');

  // Verifica a mensagem de sucesso
  await expect(page.locator('text=Perfil atualizado com sucesso')).toBeVisible();

  // Verifica se o valor do input foi atualizado
  await expect(page.locator('input[name="name"]')).toHaveValue('Antônio Editado');

  // Reverte o nome original
  await page.fill('input[name="name"]', 'Antônio');
  await page.click('button.btn-green');
});

test('editar descrição com sucesso', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  await page.fill('textarea[name="description"]', 'Produtor rural da região nordeste.');
  await page.click('button.btn-green');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil/editar');
  await expect(page.locator('text=Perfil atualizado com sucesso')).toBeVisible();
  await expect(page.locator('textarea[name="description"]')).toHaveValue('Produtor rural da região nordeste.');
});

test('editar localização com sucesso', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  await page.fill('input[name="location"]', 'Fortaleza - CE');
  await page.click('button.btn-green');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil/editar');
  await expect(page.locator('text=Perfil atualizado com sucesso')).toBeVisible();
  await expect(page.locator('input[name="location"]')).toHaveValue('Fortaleza - CE');
});

test('botão cancelar volta para o perfil', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  await page.click('a:has-text("Cancelar")');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil');
});

test('nome vazio exibe erro', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/perfil/editar');

  await page.fill('input[name="name"]', '');
  await page.click('button.btn-green');

  await expect(page).toHaveURL('http://127.0.0.1:8000/perfil/editar');
});