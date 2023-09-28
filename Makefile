# Preparing .env file with all necessary variables
env:
	cp .env.example .env

	echo "Please, to make database work correctly specify all necessary ENV variables in .env file"

# Making deployment of the project
setup:
	make docker-up
	make chmod-wp
	make composer

# Build and run docker container (WordPress will be available on http://localhost)
docker-up:
	docker compose up -d

# Stop docker container
docker-stop:
	docker compose stop

# Allow editing wordpress files locally
chmod-wp:
	sudo chmod -R 777 wordpress

# Install composer dependencies
composer:
	composer install
