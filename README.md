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
- Livewire
- Jetstream
- TailwindCSS

## Features

This is a minimal project. No app installs required but are optional through API. This attempts to follow the UNIX philosophy of "Do one thing and do it well".

## Installation
Docker or Podman is the recomended installation method. I use podman so those are the commands reflected below. There are two primary ways to install this. You can either pull the image from Docker Hub or build it yourself. Both methods are detailed below

### Docker Hub
1. ```podman run -dt -p 8000:8000 -v \`pwd\`/gift-config:/app/database:z --name giftshare danastasio/giftshare:latest

If you do not want database persistence, then just omit the -v flag: ```podman run -dt -p 8000:8000 --name giftshare danastasio/giftshare:latest```

### Build the image yourself
1. cd to the directory that will host the projet
2. ```git clone https://github.com/danastasio/giftshare.git```
3. ```cd giftshare```
4. ```podman build -t giftshare .```
5. ```mkdir gift-config```
6. ```chcon -Rt svirt_sandbox_file_t gift-config```
7. ```podman run -p 8000:8000 -v \`pwd\`/gift-config:/app/database:z --name giftshare giftshare

Unfortunately, I haven't figured out how to have artisan migrate the database after installation, so you need to create a DB and migrate it manually.

8. ```podman exec -it giftshare touch /app/database/database.db```
9. ```podman exec -it giftshare php artisan migrate --force```

Eventually I will add an /installation page that does this for you, but that day is not today.

#### Note on installing
At this time the applicaiton demands an SSL connection, and won't work without one. The image on docker and the files on github are configured for a production environment. So if you are testing this locally, you need to change the APP_ENV parameter in the .env file from 'production' to 'local', and clear the config cache. The steps on how to do that are detailed below.

## API Reference
The API currently isn't implemented. I don't recommend using it just yet.
[Documentation](https://github.com/danastasio/giftshare/wiki/API)

## Tests
Tests are built using PHPUnit and can be run with the following command:
```php artisan test```

All tests should pass

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
