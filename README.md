Paymentwall test 
========================


For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

## CLI mode:
--------------

First you need to clone project. For this enter the command in console:

```sh
git clone https://github.com/ergonomic0013/testwall.git
```

After setup DB and create table (enter command in project directory):
```sh
php bin/console db:setup
```
Default parameters:
```yaml
parameters:
database_host: 127.0.0.1
database_port: null
database_name: paymentwall
database_user: root
database_password: start
mailer_transport: smtp
mailer_host: 127.0.0.1
mailer_user: null
mailer_password: null
secret: ThisTokenIsNotSoSecretChangeIt
```
#### Commands:
Add new item:
```
php bin/console feed:add --name="Example" --url="http://www.example.com/rss"
```
`*all value are required`

`** --category must one of the following`


List all:
```
php bin/console feed:list
```

Remove item by `id`:
```
php bin/console feed:remove N
```
`*N = [1, 2, 3 ...... N];`

Current items by `id`:
```
php bin/console feed:items N
```
`*N = [1, 2, 3 ...... N];`

## GUI mode:
--------------

In GUI mode, everything is intuitively understandable for a normal user



