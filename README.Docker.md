### Building and running your application
Create [db/password.txt](https://docs.docker.com/compose/use-secrets/) that contains database password.
See further for [db/dsn](https://codeigniter.com/user_guide/database/configuration.html#configuring-with-env-file). 

When you're ready, start your application by running:
`docker compose up --build`.

Your application will be available at [http://localhost:8080](http://localhost:8080).

Using phpMyAdmin to manage database at [http://localhost:8088](http://localhost:8088).

### PHP extensions
If your application requires specific PHP extensions to run, they will need to be added to the Dockerfile. Follow the instructions and example in the Dockerfile to add them. Find supported extensions at:
[docker-php-extension-installer](https://github.com/mlocati/docker-php-extension-installer)

### Using Apache as reverse proxy
To use Apache web server instead of default NGINX reserver proxy.
Update compose.yaml:
```yml
  server:
    build:
      context: .
      dockerfile: Dockerfile-apache
```
### Deploying your application to the cloud

First, build your image, e.g.: `docker build -t myapp .`.
If your cloud uses a different CPU architecture than your development
machine (e.g., you are on a Mac M1 and your cloud provider is amd64),
you'll want to build the image for that platform, e.g.:
`docker build --platform=linux/amd64 -t myapp .`.

Then, push it to your registry, e.g. `docker push myregistry.com/myapp`.

Consult Docker's [getting started](https://docs.docker.com/go/get-started-sharing/)
docs for more detail on building and pushing.