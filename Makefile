all: copy-env docker-build

copy-env:
	@cp .env.dist .env

docker-build:
	docker compose up -d --build