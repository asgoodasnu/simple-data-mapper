# vim: set tabstop=8 softtabstop=8 noexpandtab:

DATE := $(shell date +%Y-%m-%d_%H-%M-%S)

vendor: composer.json composer.lock
	@symfony composer install --no-interaction

cs:
	# Running PHP-CS-Fixer
	@symfony composer cs-fixer

analyse:
	# Running PHPStan static code analyse
	@symfony composer phpstan

lint-twig:
	# Linting Twig files
	@symfony php bin/console lint:twig templates/

lint-yaml:
	# Linting YAML files
	@symfony php bin/console lint:yaml config/ src/ translations/ --parse-tags

test-coverage:
	@symfony composer coverage

all: cs analyse test-coverage
