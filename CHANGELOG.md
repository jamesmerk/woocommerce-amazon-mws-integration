# Change Log
All notable theme changes should be added to this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [ 0.11.0 ] - Subscription Creation Stable, Subscription Update Stable, Test Notifications Stable - latest stable version

## Added

- Test Notification Support
- Additional Model files for test notification support
- Class MWS_Test_Notifications to handle testing notifications with registered subscription destinations
- Update subscription support
- Class MWS_Subscriptions to handle creating and updating Amazon MWS Subscriptions
- Subscription Creation via Amazon SQS
- Documentation for Subscription Creation
- Amazon MWS Subscription service files and classes
- Class MWS_Destination to handle registering and deregistered Amazon MWS Notification destinations

## [ 0.10.0 ]

## Notable features

- Inventory feed can now be submitted to Amazon MWS via plugin admin area

## Added

- Send feed condition and response to WP REST API
- Feed submission list condition and response to REST API
- Feed submission result condition and response to REST API
- send feed event listener in woo-amz-integration-admin.js
- Inventory feed submission to Amazon MWS via plugin admin area
- REST API feed submission response (submission response data was previously only available in logs)

## Fixed

- PHP 5 warning where the object passed to isSetParameters() in Model/ContentType.php could not institute count() (fixed by casting the object to an array)

## [ 0.9.0 ]

## Notable features

- Stop and restart feed creation functionality now working
- Inventory file now deleted and recreated on feed restart

## Added

- Database functions to class TFS_DB_MAN
- Feed incomplete warning in plugin options interface
- Continue feed button to plugin options interface
- Feed Continue support in woo-amz-integration-admin.js
- Continue and Restart Feed functionality (still a bit buggy)
- File deletion handler to class Woo_Amz_File_Handler
- File path constants to class Woo_Amz_File_Handler

## Removed

- Database functions from woo-rest-api.php

## [ 0.8.0 ]

## Notable feature

- complete product download with variations successful

## Added

- Product variation support
- Product variations to inventory file
- File data parameters to Woo_Amz_File_Handler constructor
- Woo_Amz_File_Handler initialization to class Woo_REST_API

## Removed

- File Handler initialization from function run_woo_amz_integration()

## [ 0.7.1 ]

## Fixed

- WooCommerce REST API bug where product loop would complete before finished
- Database bug where product download would be mark as completed before being completed

## [ 0.7.0 ]

## Added

- Error log to Class MWS_FEED
- Response Logging to Class MWS_FEED

## Changed

- Reformatted invoke feed methods in Class MWS_FEED
- Invoke method exception handling 

## Fixed

- HTTP Bug where connection would not close with MWS

## [ 0.6.0 ] - 7.28.2020 - Most recent stable version for Amazon MWS

## Added

- Class MWS_FEED to handle construction and responses related to MWS feed submission
- Amazon MWS Feed submission list
- Amazon MWS Feed submission results
- New Model files related to Feed Lists and Feed Results
- Class DB_MAN to manage database operations within plugin

## [ 0.6.0 ] - 7.27.2020

# Added

- Amazon MWS API Support
- Amazon MWS Feed submission files

## [ 0.5.0 ] - 7.9.2020

## Added

- Delete file feature if a file exists and user wants to create a new one
- Admin nonces
- Download button support (now works
- Inventory feed row reset

## Removed

- Dynamic SQL row creation (only one row will be needed)

## [ 0.5.0 ] - 7.7.2020 - Most recent stable version

## Added

- Stop feed creation button, download file button and send file button to settings menu 
- Admin notice for whether or not an inventory file exists
- Progress messages to admin menu to notify when the feed is running, etc.
- WP REST API Json response to deliver information about feed while running
- Basic CSS

## Changed

- Admin settings menu
- Asynchronous product tracker to be more accurate

## Removed

- JS Ajax progress checker function

## [ 0.4.0 ] - 7.7.2020

## Added

- class Woo_Amz_File_Handler to create product inventory files
- documentation for woo-rest-api.php and class-woo-amz-file-handler.php

## [ 0.3.0 ] - 7.6.2020

## Added

- Database creation on plugin activation
- Custom SQL table creation, custom SQL columns for plugin feed download progress
- URL query string for triggering feed creation via CRON (trigger script)
- URL query string for triggering feed restart if it doesn't complete (process script)
- Feed restart callback function (checks if feed is finished, if not continue where it left off)

## [ 0.3.0 ] - 7.3.2020

## Added 

- Progress Tracker and SSE integration ( checks progress of product data download )
- WP REST API ( used for MWS calls to amazon and tracking product data download progress )
- Options.php to keep track of saved options in plugin settings
- Plugin settings menu
- WP Admin navigation menu
- Ability to start product feed creation from WP Admin

## [ 0.2.0 ]

## Added

- REST API file and Class Woo_REST_API to handle api calls
- WooCommerce REST API Keys
- WooCommerce REST API integration (gets data from woocommerce installation such as stock and pricing)
- Product objects containing each product's sku, pricing, and stock in accordance with Amazon
- PHP composer dependency manager (required for woocommerce rest api integration)
- HTTP handler for WooCommerce REST API (allows internal and external communication from website)
