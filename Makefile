help: ## Available Makefile commmands
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Build app
	docker-compose build
	@make add-git-hooks
	@make clear-cache

composer-install: ## Install dependencies
	docker exec -it -w /code skeleton_php_1 /bin/sh -c "composer install"

composer-update: ## Update dependencies
	docker exec -it -w /code skeleton_php_1 /bin/sh -c "composer update"

up: ## Docker up
	docker-compose up

down: ## Docker down
	docker-compose down

nginx: ## Access Nginx bash
	docker exec -it -w /code skeleton_web_1 /bin/sh

php: ## Access PHP bash
	docker exec -it -w /code skeleton_php_1 /bin/sh

add-git-hooks: ## Add custom git hooks
	@echo "Adding hooks for git...."
	@cd .git/hooks && ln -s ../../pre-commit pre-commit || echo 'Git Hooks already added.'
	@echo "Done."

clear-cache: ## Add custom git hooks
		rm -rf var/cache var/log
		mkdir var/cache var/log
		chmod -R 777 var/cache var/log

test: ## Run unit tests
	docker exec -it -w /code skeleton_php_1 /bin/sh -c 'php ./vendor/bin/phpunit -c /code/phpunit.xml --no-coverage'

test-coverage: ## Run tests with coverage
	docker exec -it -w /code skeleton_php_1 /bin/sh -c 'XDEBUG_MODE=coverage php ./vendor/bin/phpunit -c /code/phpunit.xml --coverage-html tests/coverage'

