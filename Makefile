.PHONY: help
help: ## Returns the list of available commands
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: phpunit
phpunit: ## Run bash on the Phpunit container
	docker-compose exec phpunit bash

.PHONY: t
t: ## Run tests in the Phpunit container
	docker-compose exec phpunit ./vendor/bin/phpunit

.PHONY: phpstan
phpstan: ## Run the current phpstan configuration
	docker-compose exec phpunit ./vendor/bin/phpstan analyse src tests

.PHONY: psalm
psalm: ## Run the current psalm configuration
	docker-compose exec phpunit ./vendor/bin/psalm
