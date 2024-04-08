# mt_domain_navigator
DomainNavigator is a Drupal module by More than Themes, facilitating seamless navigation between domains within your Drupal installation. Easily showcase and explore different Drupal implementations with user-friendly menu options that redirect users to corresponding domains based on key parameters.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- Docker
- DDEV

### Installation

1. **Setup DDEV**

   Run the following to setup DDEV:

   ```bash
   make setup
   ```
2. **Create a stock Drupal project, symlink the module and enable it**

   Run the following command to create a stock Drupal project, symlink the module and enable it:
   ```bash
   make drupal

3. **Launch the website**

   You can launch the website with the following command:
   ```bash
   ddev launch
   ```

#### Cleanup
When you're done, you can stop any DDEV instance with the following command:
   ```bash
   make down
   ```



## Running in Codespaces
The project is also pre-configured to run in Codespaces and start a DDEV environment there. Simply open the project in Codespaces to get started.

## Contributing
Please read CONTRIBUTING.md for details on our code of conduct, and the process for submitting pull requests to us.

## License

This project is licensed under the Apache License 2.0 - see the [LICENSE](LICENSE) file for details