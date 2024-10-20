### Disable verification of SSL/TLS certificates  
Edit application/config/database.php at line 69:
```code
    'encrypt'  => array(
		'ssl_ca' => 'cer/DigiCertGlobalRootCA.crt.pem',
        'ssl_verify' => FALSE
    ),
```  

### Building and running your application  
Create [db/password.txt](https://docs.docker.com/compose/use-secrets/) containing database password. 

When you're ready, start your application by running:  
```shell
docker compose up --build
```
If no error, the application should be ready at [http://localhost:8080](http://localhost:8080).

Tip: You can manage database via phpMyAdmin at [http://localhost:8088](http://localhost:8088).

### Install PHP extensions
Follow the instructions and example in the Dockerfile to install addtional PHP extenstions.  
Find supported extensions at: [docker-php-extension-installer](https://github.com/mlocati/docker-php-extension-installer)

### Apache Web Server

To use Apache web server instead of default NGINX reserver proxy.
Update compose.yaml at line 14:
```yml
  server:
    build:
      context: .
      dockerfile: Dockerfile-apache
```

### Deploying your application on Cloud

First, build your image, e.g.: `docker build -t swc_app .`.
If your Cloud provider uses a different CPU architecture than your development
machine (e.g., you are on a Mac M1 and your cloud provider is amd64),
you'll want to build the image for that platform, e.g.:
```shell
docker build --platform=linux/amd64 -t swc_app .
```
Then, push it to your image registry, e.g.  
```shell
docker push myregistry.com/swc_app
```
Consult Docker's [getting started](https://docs.docker.com/go/get-started-sharing/)
docs for more detail on building and pushing.
