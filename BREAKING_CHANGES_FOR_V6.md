# Breaking change notice for version 6.0.0

## Removal of `ApiVersion::LATEST` constant

The `ApiVersion::LATEST` constant has been removed to prevent semantic versioning (semver) breaking changes. Previously, this constant would automatically update every quarter when new API versions were released, causing unintended breaking changes for apps.

### Migration Guide

**If you were using the constant directly:**

```php
// Before (v5 and earlier)
$apiVersion = ApiVersion::LATEST;

// After (v6+)
$apiVersion = '2025-07'; // Explicitly specify the version you want to use
```

**In your Context::initialize():**

The `apiVersion` parameter is now **required** in `Context::initialize()`. You must explicitly specify which API version you want to use:

```php
// Before (v5 and earlier)
Context::initialize(
    apiKey: $_ENV['SHOPIFY_API_KEY'],
    apiSecretKey: $_ENV['SHOPIFY_API_SECRET'],
    scopes: $_ENV['SHOPIFY_APP_SCOPES'],
    hostName: $_ENV['SHOPIFY_APP_HOST_NAME'],
    sessionStorage: new FileSessionStorage('/tmp/php_sessions'),
    // apiVersion was optional with default ApiVersion::LATEST
);

// After (v6+)
Context::initialize(
    apiKey: $_ENV['SHOPIFY_API_KEY'],
    apiSecretKey: $_ENV['SHOPIFY_API_SECRET'],
    scopes: $_ENV['SHOPIFY_APP_SCOPES'],
    hostName: $_ENV['SHOPIFY_APP_HOST_NAME'],
    sessionStorage: new FileSessionStorage('/tmp/php_sessions'),
    apiVersion: '2025-07', // Now required - explicitly specify the version
);
```

**Finding the right API version:**

You can reference the available API versions in the `ApiVersion` class:

```php
use Shopify\ApiVersion;

// Available constants (as of this release):
ApiVersion::UNSTABLE      // "unstable"
ApiVersion::JULY_2025     // "2025-07"
ApiVersion::APRIL_2025    // "2025-04"
ApiVersion::JANUARY_2025  // "2025-01"
ApiVersion::OCTOBER_2024  // "2024-10"
// ... and older versions
```

Or you can use string literals directly:

```php
Context::initialize(
    // ... other parameters
    apiVersion: '2025-07',
);
```

**Why this change?**

By requiring explicit version specification, apps can:
- Control when they upgrade to new API versions
- Test thoroughly before upgrading
- Avoid unexpected breaking changes from automatic version updates
- Follow semantic versioning principles more accurately

**Recommended approach:**

1. Review the [Shopify API Changelog](https://shopify.dev/changelog) to understand changes between versions
2. Choose the API version that best suits your app's needs
3. Explicitly specify that version in your `Context::initialize()` call
4. Test your app thoroughly with the chosen version
5. Upgrade to newer versions on your own schedule after proper testing
