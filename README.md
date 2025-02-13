![Commercify Self Hosted](misc/readme-assets/combination-primary-on_transparent.svg)

# Commercify Self Hosted

Commercify Self Hosted (CSH) is a PHP-based framework designed for quickly developing online stores. To develop a Commercify store, you need to run CSH locally and deploy it once you're done.

## Getting Started

### Obtaining the CSH Framework

To run CSH locally, you'll first need a copy of the framework. There are several methods to obtain it:

#### 1. Download a Release

- Download the latest release from the [GitHub Releases Page](https://github.com/commercify-store/commercify-self-hosted/releases).
- Alternatively, download the latest release from [the Commercify website](https://self-hosted.commercify.com/download).

> **Note:** All CSH releases come with the necessary dependencies. There's no need to run `composer install` or `npm install`.

---

#### 2. Clone from GitHub

- Clone the repository: `git clone https://github.com/commercify-store/commercify-self-hosted.git`.
- Navigate to the CSH directory: `cd commercify-self-hosted`.
- Set up your own repository by updating the remote: `git remote remove origin && git remote add origin <your-new-repo-url>`.
- Run `composer install` and `npm install` to install all dependencies.

---

#### 3. Use the GitHub Template

- Click the **Use this template** button on GitHub to create a fresh repository with CSH included.
- Clone the new repository: `git clone <location-of-your-repo>`.
- Navigate to the CSH directory: `cd <your-repo-name>`.
- Run `composer install` and `npm install` to install all dependencies.

---

### Running the Framework

To run CSH locally, you'll need a local development environment with Apache, PHP, and MySQL/MariaDB/PostgreSQL. CSH can run on any basic LAMP stack, but we recommend using DDEV. Choose one of the options below to run CSH locally:

#### 1. Run CSH on a Local LAMP Stack

> **Note:** The base URL of your LAMP stack or the name of the framework folder might differ. Check how to reach local projects on your LAMP stack to find the correct base URL.

- Place the CSH framework folder in your web root directory.
- Navigate to `http://localhost/commercify-self-hosted/setup`.
- Follow the setup steps to complete the configuration of your local CSH instance.

---

#### 2. Run on DDEV

> **Note:** CSH currently uses **DDEV version 1.23.2** and **Docker version 27.4.1**. While you can use the latest versions of DDEV and Docker, the mentioned versions are recommended for optimal compatibility.

To install and configure DDEV, please visit [the DDEV website](https://ddev.com/) and follow the setup instructions.

- Navigate to the CSH directory: `cd commercify-self-hosted`.
- Open the `.ddev/config.yaml` file and check the PHP and MariaDB versions. Ensure they match the versions listed in the `Versions used in the current development environment` section. Alternatively, you can use your preferred version at your own risk.
- Start the project: `ddev start`.

The output should be similar to:

```
Successfully started self-hosted.commercify.store Project can be reached at https://self-hosted.commercify.store.ddev.site https://127.0.0.1:32769
```


##### Versions Used in the Current Development Environment

- **Apache**: 2.4.59
- **PHP**: 8.2.20
- **MariaDB**: 10.11
- **Composer**: 2.8.5
- **PHPUnit**: 12.0.2

If you encounter any issues, verify the versions of DDEV and Docker. You can also refer to the [DDEV documentation for troubleshooting](https://ddev.readthedocs.io/en/stable/users/usage/troubleshooting/), or contact support at support@commercify.store.

---

#### 3. Use Your Own Setup

As mentioned, CSH can run on any basic LAMP environment. You can also choose to run CSH on Docker or any other setup that suits your preferences.

## Deployment

Currently, CSH does not offer an automated deployment solution. However, due to its simple project structure, a basic (S)FTP transfer to a LAMP web server and a database migration is sufficient for deployment. Please refer to the deployment guidelines in `DEPLOYMENT.md` for detailed instructions on deploying your CSH online store.

### Custom Deployment Implementations

If you'd like to set up CI/CD pipelines or other custom deployment solutions, you're free to do so. CSH is flexible and not opinionated on deployment strategies. It is essentially a LAMP application with a straightforward setup.

