To set up a Docker Compose configuration with PHP-FPM, Nginx, PostgreSQL, and Laravel 9, you'll need to create a Dockerfile for the PHP-FPM service and configure the Nginx service to work with PHP-FPM. Here's an example of how you can structure your files:

1. Dockerfile for PHP-FPM (Dockerfile.php-fpm)
```Dockerfile
FROM php:8.0-fpm

RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html

RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["php-fpm"]

EXPOSE 9000
```

2. docker-compose.yml
```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile.php-fpm
    volumes:
      - .:/var/www/html
    depends_on:
      - db

  web:
    image: nginx:latest
    ports:
      - 80:80
    volumes:
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www/html
    depends_on:
      - app

  db:
    image: postgres:13
    ports:
      - 5432:5432
    volumes:
      - postgres_data:/var/lib/postgresql/data
    environment:
      - POSTGRES_DB=your_database_name
      - POSTGRES_USER=your_username
      - POSTGRES_PASSWORD=your_password

volumes:
  postgres_data:
```

3. nginx.conf (place it in the same directory as docker-compose.yml)
```nginx
server {
    listen 80;
    server_name localhost;
    root /var/www/html/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

4. .env file (in your Laravel 9 project)
Update the database connection details to match the PostgreSQL configuration in the docker-compose.yml file:
```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Once you have all the files in place, you can run the following command to build and start the containers:
```
docker-compose up -d --build
```

This will build the PHP-FPM and Nginx containers based on the provided configurations and start the PostgreSQL container. The `-d` flag runs the containers in detached mode, allowing them to continue running in the background.

After the containers are up and running, you should be able to access your Laravel 9 application through Nginx at `http://localhost`. Nginx will forward requests to the PHP-FPM container, which will process the PHP code and interact with the PostgreSQL container for database operations.
