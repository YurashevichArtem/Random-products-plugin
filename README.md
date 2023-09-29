## README
### How to start the project
#### Automatic installation
###### To make the installation automatic you need installed `composer:2.5.X` and `php:8.1.X` or higher.
- At first you need to specify all env variables by using command below. It will copy all ENV variables. from `.env.example` to `.env` file: 
``` 
make env
```
- Then you have to specify all ENV variables in `.env` file.
- Run command to create docker container, change chmod of the wordpress directory, install all composer dependencies and wordpress plugins:
```
make setup
``` 
Or you can run commands included to `make setup` separately. Correct sequence:
```
make docker-up
``` 
```
make chmod-wp
``` 
```
make composer
```
- Now you can open url below and install WordPress, all necessary plugins will already be installed
```
http://localhost
```

###### If you want to use manual installation you can follow the guide below.
#### Manual installation
- Copy `.env.example` to `.env`:
```
cp .env.example .env
```
- Specify all variables in `.env`
- Build and run docker container:
```
docker compose up -d
```
- Execute chmod command:
```
sudo chmod -R 777 wordpress
```
- Install composer dependencies and wordpress plugins:
```
composer install
```
You can skip `composer install` command and install `woocommerce` plugin manually from admin panel, to make everything work fine. 

### Linting:
If you want to lint code - `composer` and all its dependencies should be installed. 
- You Can specify a file to check in the `phpcs.xml` file inside `<file>` tag and then run `phpcs` to check styles:
```
make phpcs
```
- And `phpcbf` to fix styles:
```
make phpcbf
```

### This is an instruction how to make branches and commits.
###### Branch template:
- `<prefix>/<task number>-<short name>`. Prefix may be one of:
  - feature
  - fix
  - hotfix
  - refactoring
  - tools
- Example: `feature/XPRT-15-edit-general`
###### Commit template:
- `<scope>:<task number> <subject>`:
  - The `<scope>` could be anything specifying the place of the commit change. For example core, tools, common, insights, marketplace, admin, signup, campaign, creator, export, etc.
  - The `<subject>` contains succinct description of the change: 
    1. use the imperative, present tense: "change" not "changed" nor "changes"
    2. don't capitalize first letter
    3. no dot (.) at the end
- Example: `common: XPRT-123 add edit project page`

### Links:
#### Docker:
- https://hub.docker.com/_/mysql
- https://hub.docker.com/_/wordpress
- https://hub.docker.com/_/nginx
- https://hub.docker.com/_/phpmyadmin

#### Composer:
- https://packagist.org/packages/squizlabs/php_codesniffer
- https://wordpress.org/plugins/woocommerce/

#### Gitignore:
- https://git-scm.com/docs/gitignore

#### WordPress:
- https://developer.wordpress.org/plugins/shortcodes/
- https://developer.wordpress.org/plugins/settings/custom-settings-page/
- https://www.smashingmagazine.com/2019/03/composer-wordpress/

#### WooCommerce:
- https://woocommerce.com/document/importing-woocommerce-sample-data/
- https://woocommerce.com/document/introduction-to-hooks-actions-and-filters/
