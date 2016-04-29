# #NuitDebout : Questions

[Questions2Answer](http://www.question2answer.org/) + [Donut Theme](https://github.com/amiyasahu/Donut) powering [questions.nuitdebout.fr](questions.nuitdebout.fr)

## Development environment with Docker

### Installing

Install [Docker](https://docs.docker.com/) & [Docker Compose](https://docs.docker.com/compose/) on your machine.
On MacOSX, you will also need [VirtualBox](https://www.virtualbox.org/).

Then, download the latest version of Questions2Answer into the project folder using `install`

```
$ make install
```

Make sure the default Docker machine is running.
On MacOSX, you might need to launch the _Docker Quickstart Terminal_ application.

Then, run `make server-start` to launch Docker.

When everything is up and running, add an entry in your `/etc/hosts` file pointing to the default Docker machine.

```
$ docker-machine ip
192.168.99.100
```

```
192.168.99.100 questions.nuitdebout.dev
```

Open [http://questions.nuitdebout.dev/](http://questions.nuitdebout.dev/) in your web browser, and follow the installation instructions.

Go to **Admin > General**, and choose the **Donut** theme.
