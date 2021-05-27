# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres
to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.2] - 2021-05-28

### Fixed
- only start session if not already started

## [1.0.1] - 2020-03-06
### Fixed
- php notice undefined `HTTP_ACCEPT_LANGUAGE` e.g. if script called via CLI or cURL without any header information