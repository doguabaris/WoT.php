# Contributing to PHP WoT

Hi there! We're thrilled that you'd like to contribute to this project. Your help is essential for keeping it great.

Please note that this project is released with a [Contributor Code of Conduct](CODE_OF_CONDUCT.md). By participating in this project, you agree to abide by its terms.

## Issues and PRs

If you have suggestions for how this project could be improved or want to report a bug, open an issue! We'd love all and any contributions. If you have questions, too, we'd love to hear them.

We'd also love PRs. If you're thinking of a large PR, we advise opening up an issue first to discuss it. Check out the links below if you're unsure how to open a PR.

## Submitting a Pull Request

1. [Fork](https://github.com/doguabaris/WoT.php/fork) and clone the repository.
2. Install the dependencies:
   ```bash
   composer install
   ```
3. Run the tests to ensure everything is working:
   ```bash
   composer test
   ```
4. Create a new branch:
   ```bash
   git checkout -b my-branch-name
   ```
5. Make your changes, add tests, and ensure the tests still pass.
6. Push your branch to your fork:
   ```bash
   git push origin my-branch-name
   ```
7. Open a [pull request](https://github.com/doguabaris/WoT.php/compare).
8. Wait for your pull request to be reviewed and merged.

### Tips for a Successful Pull Request

- Follow the [PSR-12 style guide](https://www.php-fig.org/psr/psr-12/). Run `composer phpcs` to check for linting errors.
- Add or update tests to cover your changes.
- Keep your changes focused. Submit separate pull requests for unrelated changes.
- Write a [clear and descriptive commit message](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html).

Work-in-progress pull requests are also welcome if you'd like feedback early or if something is blocking you.

## Resources

- [How to Contribute to Open Source](https://opensource.guide/how-to-contribute/)
- [Using Pull Requests](https://help.github.com/articles/about-pull-requests/)
- [GitHub Help](https://help.github.com)

## License

By contributing, you agree that your contributions will be licensed under the [MIT License](LICENSE).
