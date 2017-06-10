composer exec codecept bootstrap
php artisan auditing:install
//php artisan migrate --path=vendor/venturecraft/revisionable/src/migrations
php artisan vendor:publish --provider="Spatie\TranslationLoader\TranslationServiceProvider" --tag="migrations"
behat --init