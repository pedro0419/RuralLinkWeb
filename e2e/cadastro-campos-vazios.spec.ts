import { test, expect } from '@playwright/test';

test('todos os campos vazios', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});

test('sem nome', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="email"]', 'teste@gmail.com');
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'Senha@1234');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});

test('sem email', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'Senha@1234');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});

test('sem telefone', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', 'teste@gmail.com');
  await page.fill('input[name="location"]', 'Fortaleza');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'Senha@1234');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});

test('sem cidade', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', 'teste@gmail.com');
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="password"]', 'Senha@1234');
  await page.fill('input[name="password_confirmation"]', 'Senha@1234');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});

test('sem senha', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/registrar');

  await page.fill('input[name="name"]', 'João Teste');
  await page.fill('input[name="email"]', 'teste@gmail.com');
  await page.fill('input[name="phone"]', '(85) 99999-9999');
  await page.fill('input[name="location"]', 'Fortaleza');

  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/registrar');
});