logger-symfony
==============

A Symfony project created on March 29, 2018, 9:28 am.

### Setup:
1. run
`cp app/config/parameters.yml.dist app/config/parameters.yml`
2. edit `app/config/parameters.yml` and make sure the credentials match existing database user
3. run
`php bin/consoledoctrine:database:create`
4. run 
`php bin/consoledoctrine:schema:update --force`
5. to load fixtures (optional) run:
`php bin/console doctrine:fixtures:load -q`
6. to check the form, go to:
`/example-form?test=1&test3=4` and submit the file and text fields
