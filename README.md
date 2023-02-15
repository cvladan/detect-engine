# Detect-CMS

PHP Library for detecting CMS

## Install

```bash
composer require krisseck/detect-cms:dev-master
```

## How to use:

    include(__DIR__ . "/vendor/autoload.php");
    $domain = "http://google.com";
    $cms = new \DetectCMS\DetectCMS($domain);
    if($cms->getResult()) {
        echo "Detected CMS: ".$cms->getResult();
    } else {
        echo "CMS couldn't be detected";
    }

## Test Phar file

In the browser, enter URL:

```
detect-engine/index.php?url=wp.org
```

or in command-line:

```
php example.phar url=wp.org
```

`box.phar` also created `Dockerfile` that I never tested.
