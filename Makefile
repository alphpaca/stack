tools.install:
	@composer update -d tools/coding-standard
	@composer update -d tools/monorepo-builder
	@composer update -d tools/pest
	@composer update -d tools/phpstan
