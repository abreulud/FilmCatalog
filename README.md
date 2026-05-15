# FilmCatalog
Mini projeto de API de catálogo de filmes utilizando PHP e Laravel.

## Como rodar o projeto localmente

1. **Clone o repositório**
   ```sh
   git clone https://github.com/abreulud/FilmCatalog.git
   cd FilmCatalog
   ```
2. **Instale as dependências**
   ```sh
   composer install
   ```
3. **Copie e ajuste o arquivo de ambiente**
   ```sh
   cp .env.example .env
   ```
   Ajuste as variáveis do arquivo `.env` de acordo com sua configuração local.

4. **Gere a chave da aplicação**
   ```sh
   php artisan key:generate
   ```
5. **Execute as migrations**
   ```sh
   php artisan migrate
   ```
6. **(Opcional) Popule o banco:**
   ```sh
   php artisan db:seed
   ```
7. **Rode o servidor de desenvolvimento**
   ```sh
   php artisan serve
   ```
> Obs: para ver as rotas digite:
```php artisan route:list```

Pronto! O sistema vai rodar em `http://localhost:8000`.
