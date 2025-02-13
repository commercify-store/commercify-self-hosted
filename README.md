![Commercify Self Hosted](misc/readme-assets/combination-primary-on_transparent.svg)

# Commercify Self Hosted

Commercify Self Hosted (CSH) is a PHP based framework to quickly develop online stores. To develop a Commercify store, you need to run CSH locally, and deploy it when you are done.

## Getting started

### Get a copy of the CSH framework

To run CSH locally, first you need to have a local copy of the framework on your machine. There are different ways to get a copy of CSH:

#### 1. Download a release

- Download a release on [Github's releases page](https://github.com/commercify-store/commercify-self-hosted/releases).
- *Alternatively, download the latest release on [the Commercify website](https://self-hosted.commercify.com/download).*

> **_NOTE:_**  All CSH releases already contain all necessarry dependencies. You do not need to run `composer install` or `npm install`.

---

#### 2. Clone from Github

- Clone this repo: `git clone https://github.com/commercify-store/commercify-self-hosted.git`.
- Navigate to the CSH folder: `cd commercify-self-hosted`.
- Make sure to make your own repo and update the remote: `git remote remove origin && git remote add origin <your-new-repo-url>`.
- Run `composer install` and `npm install` to get all the dependencies.

---

#### 3. Use the Github template

- Click on the `Use this template` button on Github to create a fresh repo with CSH included.
- Clone the fresh repo from the template: `git clone <location-of-your-repo>`.
- Navigate to the CSH folder: `cd <your-repo-name>`.
- Run `composer install` and `npm install` to get all the dependencies.

---

### Run the framework

To run CSH locally, you need a local development environment that runs Apache, PHP and MySQL/MariaDB/PostgreSQL. CSH can run on any basic LAMP stack, but it is adviced to use DDEV. Choose one of the options below to run CSH locally:

#### 1: Run CSH on a local LAMP stack

> **_NOTE:_**  The base URL of your LAMP stack or the name of the framework folder may differ from the example above. Check how to reach local projects on your LAMP stack to find the correct base URL.

- Place the CSH framework folder in your web root directory.
- Navigate to `http://localhost/commercify-self-hosted/setup`.
- Follow the steps on the setup page to finish configuring your local CSH instance.

---

#### 2: Run on DDEV

> **_NOTE:_**  Currently CSH uses **DDEV version 1.23.2** and **Docker version 27.4.1** To make sure your development environment works with CSH, you can use the same versions. But you can also use the newest versions of DDEV and Docker, as it should not have too much influence on CSH working or not.

To install and configure DDEV, please visit [the DDEV website](https://ddev.com/) and follow the instructions.

- Navigate to the CSH folder: `cd commercify-self-hosted`.
- Open the file `.ddev/config.yaml` and check the versions for PHP and MariaDB. Make sure they are the same as the versions listed above in the `Versions used in the current development environment` section. Alternatively, use your own preferred version at your own risk.
- Start the project: `ddev start`.

The output of `ddev start` should be similar to this:

```
Successfully started self-hosted.commercify.store 
Project can be reached at https://self-hosted.commercify.store.ddev.site https://127.0.0.1:32769
```

##### Versions used in the current development environment

- **Apache**: 2.4.59
- **PHP**: 8.2.20
- **MariaDB**: 10.11
- **Composer**: 2.8.5
- **PHPUnit**: 12.0.2

If you encounter any errors, check the versions of DDEV and Docker. Also check the [DDEV documentation to troubleshoot](https://ddev.readthedocs.io/en/stable/users/usage/troubleshooting/) any issues, or send an email to support@commercify.store if you cannot find a solution.

---

#### 3: Or choose your own way

As mentioned before, CSH can run on any basic LAMP environment. You can also run CSH on Docker for example, if you prefer to just use Docker instead of adding DDEV to your local development environment. Pick your own way to run CSH if you so prefer.

## Deployment

Currently, CSH does not have any solutions for (automated) deployment. However, because of the straightforward project structure, a simple (S)FTP transfer to a LAMP webserver and database migration is sufficient for deployment. Follow the deployment guidelines in DEPLOYMENT.md for more information on deploying you CSH online store.

### Your own implementations for deployment

If you wish to work with pipelines (CI/CD for example), you can do that by yourself. CSH is not opinionated on that level. It is simply a LAMP application with a simple setup.