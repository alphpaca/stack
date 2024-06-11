mono-merge:
	@echo "Merging composer.json files"
	@php vendor/bin/monorepo-builder merge
mono-propagate:
	@echo "Propagating composer.json files"
	@php vendor/bin/monorepo-builder propagate
ci:
	vendor/bin/composer-dependency-analyser
	vendor/bin/php-cs-fixer fix --diff
	vendor/bin/phpstan analyse
	vendor/bin/phpunit
