# vim: set tabstop=8 softtabstop=8 noexpandtab:

DATE := $(shell date +%Y-%m-%d_%H-%M-%S)

vendor: composer.json composer.lock
	@symfony composer install --no-interaction

cs:
	# Running PHP-CS-Fixer
	@PHP_CS_FIXER_IGNORE_ENV=1 symfony php vendor/bin/php-cs-fixer fix

analyse:
	# Running PHPStan static code analyse
	@symfony php vendor/bin/phpstan analyse src/ tests/ --level 7

lint-twig:
	# Linting Twig files
	@symfony php bin/console lint:twig templates/

lint-yaml:
	# Linting YAML files
	@symfony php bin/console lint:yaml config/ src/ translations/ --parse-tags

test-coverage:
	@symfony php vendor/bin/phpunit -v --coverage-clover coverage_html/clover-coverage.xml --coverage-html coverage_html --log-junit coverage_html/junit.xml

all: cs analyse test-coverage
