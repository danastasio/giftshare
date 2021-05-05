#Copyright (C) 2020  David D. Anastasio

#This program is free software: you can redistribute it and/or modify
#it under the terms of the GNU Affero General Public License as published
#by the Free Software Foundation, either version 3 of the License, or
#(at your option) any later version.

#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
#GNU Affero General Public License for more details.

#You should have received a copy of the GNU Affero General Public License
#along with this program.  If not, see <https://www.gnu.org/licenses/>.

FROM php

RUN apt-get update -y && apt-get install -y libmcrypt-dev sqlite3 libsqlite3-dev git zip unzip uuid-runtime

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo

WORKDIR /app
COPY . /app

RUN composer install --no-interaction
RUN cp /app/.env.example /app/.env
RUN sed -i "s/REPLACEDB/database.db/g" /app/.env
RUN touch /app/database/database.db
RUN php artisan key:generate
RUN php artisan migrate

VOLUME /app/database
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
