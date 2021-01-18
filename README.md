# News-App-George

## Local Installation

1. Install docker desktop from https://www.docker.com/products/docker-desktop
2. Clone the repo to a local folder. (This will not work. The repo is private at the moment use the zip provided)

    ```
    git clone https://github.com/georgejoseph1994/news-app.git
    cd news-app
    ```

3. Copy .env.example file as .evn

    ```
    cp .env.example .env
    ```

4. Fill in the missing environment variables given below in the .env file.

    ```
    GUARDIAN_NEWS_API_KEY=Fill in here with your key
    ```

5. Install php dependencies via composer.

    ```
    composer install
    ```

6. Start Laravel Sail.

    ```
    ./vendor/bin/sail up
    ```

7. Generate app key.

    ```
    ./vendor/bin/sail artisan key:generate
    ```

8. Run the database migrations

    ```
    ./vendor/bin/sail artisan migrate
    ```

9. Install npm dependencies

    ```
    ./vendor/bin/sail npm install
    ```

10. Compile the javascript code
    ```
    ./vendor/bin/sail npm run dev
    ```

## To do

-   [x] Create laravel skeleton with sail.
-   [x] Run migrations for the tables.
-   [x] Create the news search rest api.
-   [x] Build basic views for the news page.
-   [x] functionality to bookmark the articles.
-   [x] Write readme.
