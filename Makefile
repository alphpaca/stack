mono-merge:
	@echo "Merging composer.json files"
	@php vendor/bin/monorepo-builder merge
mono-propagate:
	@echo "Propagating composer.json files"
	@php vendor/bin/monorepo-builder propagate
