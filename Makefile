tools.install:
	@composer update -d tools/coding-standard
	@composer update -d tools/monorepo-builder
	@composer update -d tools/pest
	@composer update -d tools/phpstan

ci.coding_standard:
	@bin/cs

ci.code_quality:
	@bin/phpstan

ci.monorepo_checks:
	@bin/monorepo-builder validate

ci.tests:
	@bin/pest

ci:
	@make ci.code_quality
	@make ci.coding_standard
	@make ci.monorepo_checks
	@make ci.tests
