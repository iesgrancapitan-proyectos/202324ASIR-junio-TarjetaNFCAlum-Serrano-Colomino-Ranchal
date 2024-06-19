# Proyecto: Tarjetas de prepago NFC

El entorno se instalará en una máquina con sistema operativo Ubuntu o derivado de Debian.

## Instalación e implementación del entorno

### Software necesario para el funcionamiento de la página

```
sudo apt update
sudo apt install apache2 php8.2 libapache2-mod-php8.2 php8.2-mysql mariadb-server
```

### Crear base de datos e importar datos de archivos SQL

```
sudo mysql -u root
CREATE DATABASE grancapitan;
exit
sudo mysql -u root grancapitan < proyectonfc.sql
```

### Añadir línea a archivo .bashrc presente en el directorio personal del usuario

```
export DB_PASSWORD="Root1234$"
```

### Archivo de configuración /etc/apache2/sites-available/proyecto.conf

```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/proyecto
    ServerName kioskos.iesgrancapitan.org
    DirectoryIndex index.html index.php

    <Directory />
        Options FollowSymLinks
        AllowOverride None
        Require all denied
    </Directory>
    <Directory /var/www/proyecto/>
        Options FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>

    # Alias para /takeaway
    Alias /takeaway /var/www/proyecto/view/indextienda.php

    <Files "indextienda.php">
        Options FollowSymLinks
        AllowOverride None
        Require all granted
    </Files>
</VirtualHost>
```

### Aplicar configuración sitio

```
sudo a2ensite proyecto.conf
sudo apache2ctl configtest
sudo systemctl restart apache2
```
