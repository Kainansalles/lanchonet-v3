# LanchoNET
API REST PHP + Laravel + MySQL + Laradock

## Getting Started

Webservice do aplicativo LanchoNET desenvolvido em Lumen.

### Instalação lanchonet

Entre no diretório principal e atualize o repositório, lembre-se de ter uma versão do PHP recente.

```
composer update
```

Para funcionar os comandos do Artisan, crie um arquivo '.env' com base no '.env.exemple' na raiz do projeto para esse formato:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=lanchonet
DB_USERNAME=root
DB_PASSWORD=root
```

Abra o etc/vhosts e adicione:
```
127.0.0.1       mysql
```

Para envio de e-mail, basta configurar com informaçes abaixo:
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_FROM_ADDRESS=seuemail
MAIL_FROM_NAME=seunome
MAIL_USERNAME=seuusuario
MAIL_PASSWORD=suasenha
MAIL_ENCRYPTION=tls
```

### Instalação laradock

Abra o arquivo .env do seu projeto laradock e altere as seguintes propriedades:
```
APP_CODE_PATH_HOST=../
DATA_PATH_HOST=../data/
MYSQL_VERSION=5.7
```
