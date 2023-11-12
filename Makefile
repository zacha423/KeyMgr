# --------------- DEV ----------------

build: all-dockers-down
	docker compose -f ./docker-compose.yaml build --pull

serve: build
	docker compose -f ./docker-compose.yaml up

# --------------- TESTING ----------------

test: clear-cache
	# returns 0 iff "php" container is running
	docker inspect -f '{{.State.Running}}' php
	$(MAKE) -C . test-unit
	$(MAKE) -C . test-integration

test-unit:
	docker exec php phpunit

test-integration:
	docker exec php php artisan dusk || docker exec php dusk-failure-report.sh

# --------------- CLEANUP ----------------

all-dockers-down:
	docker compose -f ./docker-compose.yaml down

clear-db-data:
	rm -rf docker/postgres*

# all rules are phony, no exception
.PHONY: build build-prod all-dockers-down serve serve-prod rebuild-db seed clear-db-data php-install wait-for-serve clear-cache test test-unit test-integration composer-update