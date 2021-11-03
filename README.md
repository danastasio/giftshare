# README

## GiftShare (WIP)

## Motivation

Sharing Christmas and Birthday lists is always a pain when there are a large number of people. This is my attempt to alleviate some of that burden. This service allows you to add items to a list, and share that list with others. Once shared, other users will be able to claim items from your list. Once claimed these items will not appear to other users and importantly, you will not be able to tell that the item was claimed or who claimed it.

## Build status

WIP

## Screenshots

![Dashboard](https://gifts.danastas.io/images/dashboard.png?)
![Sharing Center](https://gifts.danastas.io/images/sharing_center.png?)
![My List](https://gifts.danastas.io/images/mylist.png?)

## Tech/framework used

Built with

- Laravel
- Jetstream
- TailwindCSS

## Features

This is a minimal project. No app installs required but are optional through API. This attempts to follow the UNIX philosophy of "Do one thing and do it well".

## Installation
Docker or Podman is the recomended installation method. I use podman so those are the commands reflected below.

01. cd to the directory that will host the projet
02. git clone https://github.com/danastasio/giftshare.git
03. podman build -t giftshare .
04. podman run -p 8000:8000 -v $HOME/gift-config:/app/database:z --name giftshare giftshare

Unfortunately, I haven't figured out how to have artisan migrate the database after installation, so you need to create a DB and migrate it manually.

05. podman exec -it giftshare touch /app/database/database.db
06. podman exec -it giftshare php artisan migrate --force

## API Reference

[Documentation](https://github.com/danastasio/giftshare/wiki/API)

## Tests

NYI/WIP

## How to use?

[Documentation](https://github.com/danastasio/giftshare/wiki/Usage)

## Contribute

If you have any ideas, just open an issue and tell me what you think.

If you'd like to contribute, please fork the repository and make changes as you'd like. Pull requests are warmly welcome.

You can reach out to us through on our [Matrix room](https://matrix.to/#/#giftshare:danastas.io)

## Credits

### Developers that have contributed merged commits:
- David Anastasio

## License
GNU AGPLv3
