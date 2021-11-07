start:
	php artisan serve --host 0.0.0.0
setup:
	composer install
	npm install
	cp -n .env.example .env || true
	touch database/database.sqlite || true
	php artisan key:gen --ansi
	npm ci
watch:
	npm run watch
migrate:
	php artisan migrate
console:
	php artisan tinker
log:
	tail -f storage/logs/laravel.log
deploy:
	git push heroku
detect:
	composer phpmd app ansi phpmd.ruleset.xml
lint:
	composer phpcs
lint-fix:
	composer phpcbf
install:
	composer install
test:
	php artisan config:clear
	php artisan test
clear:
	php artisan route:clear
	php artisan view:clear
	php artisan cache:clear
	php artisan config:clear
push:
	git push origin worker