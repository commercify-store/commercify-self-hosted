![Commercify Self Hosted](misc/readme-assets/combination-primary-on_transparent.svg)

# Commercify Self Hosted

Commercify Self Hosted (CSH) is a PHP based framework to quickly develop online stores. To develop a Commercify store, you need to run CSH locally, and deploy it when you are done.

## Set up locally

To run CSH locally, you need a local development environment that runs Apache, PHP and MySQL/MariaDB. CSH can run on any basic LAMP stack, but it is adviced to use DDEV.

### Set up using DDEV

To install and configure DDEV, please visit [the DDEV website](https://ddev.com/) and follow the instructions.

> **_NOTE:_**  Currently CSH uses **DDEV version 1.23.2** and **Docker version 27.4.1** To make sure your development environment works with CSH, you can use the same versions. But you can also use the newest versions of DDEV and Docker, as it should not have too much influence on CSH working or not.

#### Versions used in the current development environment

- **Apache**: 2.4.59
- **PHP**: 8.2.20
- **MariaDB**: 10.11
- **Composer**: 2.8.5
- **PHPUnit**: 12.0.2

---

### Follow these steps to configure CSH locally on your machine

- Clone this repo: `git clone https://github.com/commercify-store/commercify-self-hosted.git` or click on the `Use this template` button on Github to create a fresh repo with CSH included.
	- If you clone the CSH repo, make sure to make your own repo and update the remote:
		- `git remote remove origin && git remote add origin <your-new-repo-url>`.
- Navigate to the project folder: `cd commercify-self-hosted` and open the folder in your preferred code editor or IDE (we use VSCode).
- Run `composer install` and `npm install`.
- Open the file `.ddev/config.yaml` and check the versions for PHP and MariaDB. Make sure they are the same as the versions listed above in the `Versions used in the current development environment` section. Alternatively, use your own preferred version at your own risk.
- Start the project: `ddev start`.

---

The output of `ddev start` should be similar to this:

```
Successfully started self-hosted.commercify.store 
Project can be reached at https://self-hosted.commercify.store.ddev.site https://127.0.0.1:32769
```

If you encounter any errors, check the versions of DDEV and Docker. Also check the [DDEV documentation to troubleshoot](https://ddev.readthedocs.io/en/stable/users/usage/troubleshooting/) any issues, or send an email to support@commercify.store if you cannot find a solution.

## Deployment

Currently, CSH does not have any solutions for (automated) deployment. However, because of the straightforward project structure, a simple (S)FTP transfer to a LAMP webserver and database migration is sufficient for deployment. Follow the deployment guidelines in DEPLOYMENT.md for more information on deploying you CSH online store.

### Your own implementations for deployment

If you wish to work with pipelines (CI/CD for example), you can do that by yourself. CSH is not opinionated on that level. It is simply a LAMP application with a simple setup.