# Releasing shopify-php-api

1. Check the Semantic Versioning page for info on how to version the new release: [http://semver.org](http://semver.org)

1. Ensure your local repo is up-to-date

   ```bash
   git checkout main && git pull
   ```

1. Add an entry for the new release to `CHANGELOG.md`, and/or move the contents from the _Unreleased_ to the new release

1. Increment the version in `src/version.php`

1. Stage the `CHANGELOG.md` and `src/version.php` files

   ```bash
   git add CHANGELOG.md src/version.php
   ```

1. To update the version, commit and push the changes and create the appropriate tag - Packagist will pick it up and release it
