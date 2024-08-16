### Building and running your application
Create a password.txt in .env directory that contains database password.

When you're ready, start your application by running:
`docker compose up --build`.

Your application will be available at http://localhost:9000.

### PHP extensions
If your application requires specific PHP extensions to run, they will need to be added to the Dockerfile. Follow the instructions and example in the Dockerfile to add them. Find supported extensions at:
[docker-php-extension-installer](https://github.com/mlocati/docker-php-extension-installer)

### Deploying your application to the cloud

First, build your image, e.g.: `docker build -t myapp .`.
If your cloud uses a different CPU architecture than your development
machine (e.g., you are on a Mac M1 and your cloud provider is amd64),
you'll want to build the image for that platform, e.g.:
`docker build --platform=linux/amd64 -t myapp .`.

Then, push it to your registry, e.g. `docker push myregistry.com/myapp`.

Consult Docker's [getting started](https://docs.docker.com/go/get-started-sharing/)
docs for more detail on building and pushing.