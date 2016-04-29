default: usage

install:
	@ bin/install

server-start:
	docker-compose up -d

server-stop:
	docker-compose stop

usage:
	@printf "Usage: make [TARGET]\n\n"
	@printf "Target list :\n\n"
	@printf "   install                      Download & extract Q2A\n"
	@printf "   server-start                 Starts the server\n"
	@printf "   server-stop                  Stops the server\n"
