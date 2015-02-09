PORT=8000

run-tests: ; vendor/bin/phpunit
build-docs: ; apigen generate --source=src/ --destination=docs/
docs-server: ; php -S localhost:$(PORT) -t docs/
coverage-report: ; vendor/bin/phpunit --coverage-html=coverage/
coverage-report-server: ; php -S localhost:$(PORT) -t coverage/
