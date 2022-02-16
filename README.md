<!-- SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![License][license-shield]][license-url]

<h3>Modularity Boilerplate</h3>
<p>
  A boilerplate repo for modules.
  <br />
  <a href="https://github.com/helsingborg-stad/modularity-boilerplate/issues">Report Bug</a>
  ·
  <a href="https://github.com/helsingborg-stad/modularity-boilerplate/issues">Request Feature</a>
</p>

## Table of Contents
- [Table of Contents](#table-of-contents)
- [About Modularity Boilerplate](#about-modularity-boilerplate)
  - [Built With](#built-with)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgements](#acknowledgements)

## About Modularity Boilerplate

Create a new module at record speed! Read the installation instructions below. Setup files will automaticly be removed upon setup.

### Built With

* PHP
* NPM
* Webpack
* Modularity

### Prerequisites

This is an example of how to list things you need to use the software and how to install them (mac os).
* composer
```sh
brew install composer
```
* npm
```sh
brew install node
```
* modularity
```sh
composer require helsingborg-stad/modularity
```
### Installation

1. Clone the repo
```sh
git clone https://github.com/helsingborg-stad/modularity-boilerplate.git
```
2. Edit setup.json file, add your details
```sh
nano setup.json
```
3. Run setup procedure
```sh
php setup.php
```
4. Install and build NPM packages
```sh
npm install && npm run build
```
5. Install composer packages
```sh
composer install
```

## Roadmap

See the [open issues][issues-url] for a list of proposed features (and known issues).

## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the [MIT License][license-url].

## Acknowledgements

- [othneildrew Best README Template](https://github.com/othneildrew/Best-README-Template)


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/helsingborg-stad/modularity-boilerplate.svg?style=flat-square
[contributors-url]: https://github.com/helsingborg-stad/modularity-boilerplate/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/helsingborg-stad/modularity-boilerplate.svg?style=flat-square
[forks-url]: https://github.com/helsingborg-stad/modularity-boilerplate/network/members
[stars-shield]: https://img.shields.io/github/stars/helsingborg-stad/modularity-boilerplate.svg?style=flat-square
[stars-url]: https://github.com/helsingborg-stad/modularity-boilerplate/stargazers
[issues-shield]: https://img.shields.io/github/issues/helsingborg-stad/modularity-boilerplate.svg?style=flat-square
[issues-url]: https://github.com/helsingborg-stad/modularity-boilerplate/issues
[license-shield]: https://img.shields.io/github/license/helsingborg-stad/modularity-boilerplate.svg?style=flat-square
[license-url]: https://raw.githubusercontent.com/helsingborg-stad/modularity-boilerplate/master/LICENSE
[product-screenshot]: images/screenshot.png