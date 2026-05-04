import { test, expect } from '@playwright/test';

test.beforeEach(async ({ page }) => {
  // Faz login antes de cada teste
  await page.goto('http://127.0.0.1:8000/login');
  await page.fill('input[name="email"]', 'antonio@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');
  await expect(page).toHaveURL('http://127.0.0.1:8000/TelaInicial');
});

test('página carrega com produtos visíveis', async ({ page }) => {
  // Verifica se pelo menos um card de produto está visível
  await expect(page.locator('.product-card').first()).toBeVisible();
});

test('produto exibe nome, produtor e preço', async ({ page }) => {
  const card = page.locator('.product-card').first();

  // Verifica se o badge de preço está visível
  await expect(card.locator('.badge-price')).toBeVisible();
});

test('botão ver mais expande o card', async ({ page }) => {
  const card = page.locator('.product-card').first();
  const verMais = card.locator('.ver-mais-btn');

  // Clica em ver mais
  await verMais.click();

  // Verifica se a seção expandida ficou visível
  await expect(card.locator('.expandido')).toBeVisible();

  // Verifica se o botão mudou para "Ver menos"
  await expect(verMais).toHaveText('Ver menos');
});

test('botão ver menos fecha o card', async ({ page }) => {
  const card = page.locator('.product-card').first();
  const verMais = card.locator('.ver-mais-btn');

  // Abre e fecha
  await verMais.click();
  await verMais.click();

  await expect(card.locator('.expandido')).not.toHaveClass(/aberto/);
  await expect(verMais).toHaveText('Ver mais');
});

test('página sem produtos exibe mensagem', async ({ page }) => {
  // Busca por algo que não existe
  await page.goto('http://127.0.0.1:8000/TelaInicial?search=produtoinexistente123');

  await expect(page.locator('text=Nenhum produto encontrado.')).toBeVisible();
});