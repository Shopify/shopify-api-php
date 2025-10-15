# Adding a New API Version to Shopify API PHP

## Overview
This guide provides step-by-step instructions for adding a new API version to the Shopify API PHP library. This example uses the addition of the 2025-07 API version as a reference, but the process applies to any new API version.

## Prerequisites
- Understanding of any breaking changes or removed resources in the new API version

## Step 1: Update API Version Constants

### Add New Version Constant
Edit `src/ApiVersion.php` to add your new version:

```php
// Add the new constant following the naming pattern
public const JULY_2025 = "2025-07";  // Replace with your version

// If this is the latest version, update the LATEST constant
public const LATEST = self::JULY_2025;  // Update from previous latest
```

**Naming Convention:**
- Format: `{MONTH}_{YEAR}`
- Examples: `APRIL_2025`, `JULY_2025`, `OCTOBER_2025`

## Step 2: Create Directory Structure

### Create Source Directory
```bash
mkdir src/Rest/Admin{YYYY_MM}/
```
Example: `src/Rest/Admin2025_07/`

### Create Test Directory
```bash
mkdir tests/Rest/Admin{YYYY_MM}/
```
Example: `tests/Rest/Admin2025_07/`

## Step 3: Copy and Update Resource Files

### Copy Previous Version's Files
Copy all files from the most recent API version directory:

```bash
# Copy source files
cp -r src/Rest/Admin{PREVIOUS_VERSION}/* src/Rest/Admin{NEW_VERSION}/

# Copy test files  
cp -r tests/Rest/Admin{PREVIOUS_VERSION}/* tests/Rest/Admin{NEW_VERSION}/
```

### Update Each Resource File
For each PHP file in the new directory, update:

1. **Namespace**
   ```php
   // From
   namespace Shopify\Rest\Admin{PREVIOUS_VERSION};
   
   // To
   namespace Shopify\Rest\Admin{NEW_VERSION};
   ```

2. **API Version String**
   ```php
   // From
   public static string $API_VERSION = "{PREVIOUS_VERSION}";
   
   // To
   public static string $API_VERSION = "{NEW_VERSION}";
   ```

### Example Resource File Update

**Before (Admin2025_04/Article.php)**:
```php
namespace Shopify\Rest\Admin2025_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

class Article extends Base
{
    public static string $API_VERSION = "2025-04";
    // ... rest of the file is identical
}
```

**After (Admin2025_07/Article.php)**:
```php
namespace Shopify\Rest\Admin2025_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

class Article extends Base
{
    public static string $API_VERSION = "2025-07";
    // ... rest of the file is identical
}
```

## Step 4: Update Test Files

### Rename Test Files
Update the naming convention for test files:
```
{ResourceName}{YYYYMM}Test.php
```
Example: `Article202504Test.php` → `Article202507Test.php`

### Update Test File Contents
For each test file, update:

1. **Use Statement**
   ```php
   // From
   use Shopify\Rest\Admin{PREVIOUS_VERSION}\Article;
   
   // To
   use Shopify\Rest\Admin{NEW_VERSION}\Article;
   ```

2. **Context API Version**
   ```php
   // From
   Context::$API_VERSION = "{PREVIOUS_VERSION}";
   
   // To
   Context::$API_VERSION = "{NEW_VERSION}";
   ```

3. **URL Paths in Mock Requests**
   ```php
   // From
   "https://test-shop.myshopify.io/admin/api/{PREVIOUS_VERSION}/..."
   
   // To
   "https://test-shop.myshopify.io/admin/api/{NEW_VERSION}/..."
   ```

## Step 5: Handle Breaking Changes

### Identify Removed or Modified Resources
Check the Shopify API changelog for:
- Removed resources (e.g., CustomerAddress in 2025-07)
- Modified endpoints
- Changed field names or types

### Remove Deprecated Resources
If a resource is removed in the new API version:
1. Delete the resource file from `src/Rest/Admin{NEW_VERSION}/`
2. Delete the corresponding test file from `tests/Rest/Admin{NEW_VERSION}/`

### Update Modified Resources
If a resource has changed:
1. Update the resource class properties
2. Modify the `$PATHS` array if endpoints changed
3. Update method signatures if parameters changed
4. Adjust test cases accordingly


## Checklist

- [ ] Added new version constant to `src/ApiVersion.php`
- [ ] Updated `LATEST` constant if applicable
- [ ] Created `src/Rest/Admin{NEW_VERSION}/` directory
- [ ] Created `tests/Rest/Admin{NEW_VERSION}/` directory
- [ ] Copied all resource files from previous version
- [ ] Updated namespaces in all resource files
- [ ] Updated API_VERSION in all resource files
- [ ] Renamed all test files with new version suffix
- [ ] Updated test file imports and contexts
- [ ] Updated all API URLs in test mocks
- [ ] Removed deprecated resources
- [ ] Updated modified resources
- [ ] Run all tests successfully