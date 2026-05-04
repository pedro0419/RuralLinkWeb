import { test, expect } from '@playwright/test';

test('email sem @', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  await page.fill('input[name="email"]', 'emailsemarroba');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});

test('email sem domínio', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  await page.fill('input[name="email"]', 'email@');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});

test('email com espaços', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  await page.fill('input[name="email"]', 'email @gmail .com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});

test('email com caracteres especiais inválidos', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/login');

  await page.fill('input[name="email"]', 'email#$%@gmail.com');
  await page.fill('input[name="password"]', '12345678');
  await page.click('button[type="submit"]');

  await expect(page).toHaveURL('http://127.0.0.1:8000/login');
});