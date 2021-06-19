.PHONY: all test

help: ## Available Makefile commmands
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

up: ## Docker up
	docker-compose up
down: ## Docker down
	docker-compose down
build: ## Builds docker
	docker-compose build
nginx: ## Access nginx bash
	docker exec -it -w /src skeleton_web_1 /bin/sh
php: ## Access PHP1 bash
	docker exec -it -w /src skeleton_php_1 /bin/sh