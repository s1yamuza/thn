.PHONY: all test

help: ## Available Makefile commmands
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Build app
	docker-compose build 
	@make composer-install

composer-install: ## Install dependencies
	docker exec -it -w /code skeleton_php_1 /bin/sh -c "composer install"

up: ## Docker up
	docker-compose up

down: ## Docker down
	docker-compose down

nginx: ## Access Nginx bash
	docker exec -it -w /src skeleton_web_1 /bin/sh

php: ## Access PHP bash
	docker exec -it -w /code skeleton_php_1 /bin/sh