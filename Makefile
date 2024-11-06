cs.check:
	@vendor/bin/php-cs-fixer check

cs.fix:
	@vendor/bin/php-cs-fixer fix

ci:
	@vendor/bin/composer-dependency-analyser
	@make cs.check
	@vendor/bin/phpstan analyse
	@vendor/bin/pest

mono.merge:
	@vendor/bin/monorepo-builder merge
	@composer update

ssh:
	@docker compose exec php /bin/zsh
