# ![K (sabre/katana's logo)](public/static/image/katana_logo_full.png)

sabre/katana is a [CalDAV], [CardDAV] and [WebDAV] ready-to-use server on top of
[sabre/dav]. It means you can have your own **calendars**, **tasks** and
**contacts** server in a minute, robust, safe and secure.

## Features

When sabre/katana is installed, you can:

  * manage **users** with the administration panel,
  * create, update and delete **calendars** and **tasks** with any
    [CalDAV]-compatible client,
  * create, update and delete **contacts** with any [CardDAV]-compatible
    client.

More than 35 RFC supported. See [the exhaustive list of all supported
standars][sabre_standards]. This includes: vCard 4.0, iCalendar 2.0, jCal,
jCard, iTip, iMip, ACL etc.

[WebDAV] support ongoing.

sabre/katana is powered by <img src="http://sabre.io/img/logo.png" height="20px" alt="" /> sabre/dav, the open source [CalDAV], [CardDAV] and [WebDAV] server, used by:
<img src="http://sabre.io/img/trusted/atmail.png" alt="atmail" height="60px" /> <img src="http://sabre.io/img/trusted/box.png" alt="box" height="60px" /> <img src="http://sabre.io/img/trusted/fruux.png" alt="fruux" height="60px" /> <img src="http://sabre.io/img/trusted/owncloud.png" alt="ownCloud" height="60px" />

## Install

If you get sabre/katana through an archive, skip the pre-requisites.

### Pre-requisites

To grab dependencies of the project, make sure you have [Composer] installed,
and then run:

```sh
$ composer install
```

Also, make sure you have [Bower] installed, and then run:

```sh
$ bower install
```

Then, to install sabre/katana, you have two options.

### In your browser

You need to start an HTTP server; example with the PHP built-in server:

```sh
$ php -S 127.0.0.1:8888 -t public public/.webserver.php
```

If you use another HTTP server, take a look at
`data/etc/configuration/http_servers/`, you will find more configuration files.

Then open [`127.0.0.1:8888`](http://127.0.0.1:8888) in your browser, you will be
redirected to the installation page.

### In your terminal

You need to execute the following command:

 ```sh
 $ bin/katana install
 ```

 If you are using Windows or you don't want a fancy interface, try:

 ```sh
 $ bin/katana install --no-verbose
 ```

## Update

To update sabre/katana, you have two options.

### In your browser

**under development** (sorry, we are working hard on it).

### In your terminal

  1. First solution is **manual** but more common. It requires a ZIP archive.
     Download the latest versions with the following command:

     ```sh
     $ bin/katana update --fetch-zip
     ```

     You will find the archives in the `data/share/update/` directory. To
     finally update sabre/katana, simply run:

     ```sh
     $ unzip -u data/share/update/katana_vx.y.z.zip -d .
     ```

  2. Second solution is **automatic** but less common. It requires a [PHAR]
     archive. Download the latest versions with the following command:

     ```sh
     $ bin/katana update --fetch
     ```

     You will also find the archives in the `data/share/update/` directory. To
     finally update sabre/katana, simply run:

     ```sh
     $ bin/katana update --apply data/share/update/katana_vx.y.z.phar
     ```

     The PHAR is executable. For instance:

     ```sh
     $ php data/share/update/katana_vx.y.z.phar --signature
     ```

     or

     ```sh
     $ php data/share/update/katana_vx.y.z.phar --metadata
     ```

     will respectively print the signature and the metadata of this version. Use
     `-h`, `-?` or `--help` to get help.

## Raw backup

So far, it is possible to only create a backup in your terminal, by using the
following commands:

```sh
$ bin/katana stub --zip
```

to create a ZIP archive, or

```sh
$ bin/katana stub --phar
```

to create an executable PHAR archive.

**⚠️ Warning**: The current command does not backup MySQL database.

## Supported technologies

So far, sabre/katana can be installed with [SQLite] or [MySQL]. It works in all
major browsers, except IE9 (we are working on it).

## Build status

| branch | status |
| ------ | ------ |
| master | [![Build Status](https://travis-ci.org/fruux/sabre-katana.png?branch=master)](https://travis-ci.org/fruux/sabre-katana) |

# Questions?

Head over to the [sabre/dav mailinglist][mailinglist], or you can also just
[open a ticket on GitHub][issues].

# Made at <img src="https://fruux.com/static/img/fruux/logo-big.png" height="50px" alt="fruux" />

sabre/katana is being developed by [fruux]. Drop us a line for commercial
services or enterprise support.

[Bower]: http://bower.io/
[CalDAV]: https://en.wikipedia.org/wiki/CalDAV
[CardDAV]: https://en.wikipedia.org/wiki/CardDAV
[Composer]: http://getcomposer.org/
[MySQL]: http://mysql.com/
[PHAR]: http://php.net/phar
[SQLite]: http://sqlite.org/
[WebDAV]: https://en.wikipedia.org/wiki/WebDAV
[fruux]: https://fruux.com/
[issues]: https://github.com/fruux/sabre-katana/issues/
[mailinglist]: http://groups.google.com/group/sabredav-discuss
[sabre/dav]: http://sabre.io/
[sabre_standards]: http://sabre.io/dav/standards-support/
