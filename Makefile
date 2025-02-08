cs.check:
	@PHP_CS_FIXER_IGNORE_ENV=true bin/ecs

cs.fix:
	@PHP_CS_FIXER_IGNORE_ENV=true bin/ecs --fix

ci:
	@bin/composer-dependency-analyser
	@make cs.check
	@bin/phpstan analyse
	@echo "Architecture tests:"
	@bin/pest tests/Architecture.php --compact
	@echo "Pest tests:"
	@bin/pest --compact
	@echo "Coverage tests:"
	@XDEBUG_MODE=coverage bin/pest --coverage --min=90 --compact
	@echo "Mutating tests:"
	@XDEBUG_MODE=coverage bin/pest --mutate --min=80 --compact

mono.merge:
	@bin/monorepo-builder merge
	@composer update

ssh:
	@docker compose exec php /bin/zsh
