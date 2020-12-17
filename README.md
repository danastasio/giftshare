# README

## GiftShare (WIP)

## Motivation

Sharing Christmas and Birthday lists is always a pain when there are a large number of people. This is my attempt to alleviate some of that burden. This service allows you to add items to a list, and share that list with others. Once shared, other users will be able to claim items from your list. Once claimed these items will not appear to other users and importantly, you will not be able to tell that the item was claimed or who claimed it.

## Build status

WIP

## Screenshots

![Dashboard](https://gifts.danastas.io/images/dashboard.png)
![Sharing Center](https://gifts.danastas.io/images/sharing_center.png)
![My List](https://gifts.danastas.io/images/mylist.png)

## Tech/framework used

Built with

- Laravel
- Jetstream
- TailwindCSS

## Features

This is a minimal project. No app installs required but are optional through API. This attempts to follow the UNIX philosophy of "Do one thing and do it well".

## Installation

01. cd to the directory that will host the projet
02. git clone https://github.com/danastasio/giftshare.git
03. sudo chown apache:apache storage/ -R
04. composer install
05. php artisan key:generate
06. touch database/database.db
07. cp .env.example .env
08. Modify .env accordingly
09. Move apache giftshare.conf to /etc/httpd/conf.d/giftshare.conf
10. Reload apache
11. sudo certbot --expand -d giftshare.server.com
12. sudo chcon -R -t httpd_sys_rw_content_t database/database.db
13. sudo chcon -R -t httpd_sys_rw_content_t storage
14. sudo chmod 775 storage/ -R
15. change app/Models/User.php line 30 from ```class User extends Authenticatable implements MustVerifyEmail``` to ```class User extends Authenticatable``` to disable email verification
16. npm install && npm run dev

## API Reference

[Documentation](https://github.com/danastasio/giftshare/wiki/API)

## Tests

NYI/WIP

## How to use?

[Documentation](https://github.com/danastasio/giftshare/wiki/Usage)

## Contribute

If you have any ideas, just open an issue and tell me what you think.

If you'd like to contribute, please fork the repository and make changes as you'd like. Pull requests are warmly welcome.

You can reach out to us through on our [Matrix room](https://matrix.to/#/#giftshare:davidanastasio.com)

## Credits

### Developers that have contributed merged commits:
- David Anastasio

## License

GNU AGPL v3 © David Anastasio
