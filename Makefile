run-tests: ; vendor/bin/phpunit
build-code-coverage-report: ; vendor/bin/phpunit --coverage-html=coverage/
boot-code-coverage-report-server: ; php -S localhost:8000 -t coverage/
