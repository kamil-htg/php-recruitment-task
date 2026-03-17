.PHONY: start down test shell composer-install db-create db-create-test migrate migrate-diff migrate-test

start:
	docker compose up -d --build
	docker compose exec php composer install
	@echo ""
	@echo "Application is running at http://localhost:8080"
	@echo "Health check: http://localhost:8080/health"

down:
	docker compose down

test:
	docker compose exec php vendor/bin/phpunit

shell:
	docker compose exec php bash

composer-install:
	docker compose exec php composer install

db-create:
	docker compose exec php bin/console doctrine:database:create --connection=postgresql --if-not-exists
	docker compose exec php bin/console doctrine:database:create --connection=mysql --if-not-exists

db-create-test:
	docker compose exec -e APP_ENV=test php bin/console doctrine:database:create --connection=postgresql --if-not-exists
	docker compose exec -e APP_ENV=test php bin/console doctrine:database:create --connection=mysql --if-not-exists

migrate:
	docker compose exec php bin/console doctrine:migrations:migrate --em=postgresql --no-interaction
	docker compose exec php bin/console doctrine:migrations:migrate --em=mysql --no-interaction

migrate-diff:
	docker compose exec php bin/console doctrine:migrations:diff --em=postgresql --no-interaction
	docker compose exec php bin/console doctrine:migrations:diff --em=mysql --no-interaction

migrate-test:
	docker compose exec -e APP_ENV=test php bin/console doctrine:migrations:migrate --em=postgresql --no-interaction
	docker compose exec -e APP_ENV=test php bin/console doctrine:migrations:migrate --em=mysql --no-interaction
