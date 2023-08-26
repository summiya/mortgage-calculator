# Makefile

build:
	docker-compose up -d --build

migrate:
	docker-compose exec -T app php artisan migrate

test:
	docker-compose exec -T app php artisan test

down:
	docker-compose down

