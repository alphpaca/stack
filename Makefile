cs.check:
	@PHP_CS_FIXER_IGNORE_ENV=true vendor/bin/php-cs-fixer check

cs.fix:
	@PHP_CS_FIXER_IGNORE_ENV=true vendor/bin/php-cs-fixer fix

ci:
	@vendor/bin/composer-dependency-analyser
	@make cs.check
	@vendor/bin/phpstan analyse
	@echo "Architecture tests:"
	@vendor/bin/pest tests/Architecture.php --compact
	@echo "Pest tests:"
	@vendor/bin/pest --compact
	@echo "Coverage tests:"
	@XDEBUG_MODE=coverage vendor/bin/pest --coverage --min=90 --compact
	@echo "Mutating tests:"
	@XDEBUG_MODE=coverage vendor/bin/pest --mutate --min=80 --compact

mono.merge:
	@vendor/bin/monorepo-builder merge
	@composer update

ssh:
	@docker compose exec php /bin/zsh
