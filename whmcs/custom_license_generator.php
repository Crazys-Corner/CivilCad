<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function custom_license_generator_config()
{
    $configarray = array(
        "name" => "CivilCAD License Manager",
        "description" => "Generate and manage license keys for CivilCAD.",
        "version" => "1.0",
        "author" => "Crazy",
        "fields" => array(
            // Add any configuration fields you might need here (if applicable)
        ),
    );

    return $configarray;
}

function generateLicenseKey()
{
    // Implement your custom logic to generate a license key
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $licenseKey = '';

    for ($i = 0; $i < 20; $i++) {
        $licenseKey .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $licenseKey;
}

function saveLicenseKey($serviceId, $licenseKey)
{
    // Implement your logic to save the license key to your database
    // Replace "licenses" with your actual database table name
    $query = "INSERT INTO licenses (service_id, license_key, is_expired) VALUES ('$serviceId', '$licenseKey', '0')";

    // Execute the query using WHMCS database functions
    $result = full_query($query);
}

function updateLicenseExpiryStatus($serviceId, $isExpired)
{
    // Implement your logic to update the license expiry status in the database
    // Replace "licenses" with your actual database table name
    $query = "UPDATE licenses SET is_expired = '$isExpired' WHERE service_id = '$serviceId'";

    // Execute the query using WHMCS database functions
    $result = full_query($query);
}

add_hook('AfterShoppingCartCheckout', 1, 'custom_license_generator_AfterShoppingCartCheckout');
add_hook('InvoicePaid', 1, 'custom_license_generator_InvoicePaid');
add_hook('ServiceCancel', 1, 'custom_license_generator_ServiceCancel');

function custom_license_generator_AfterShoppingCartCheckout($vars)
{
    // Ensure this hook is only triggered for your specific product/service
    $productId = 123; // Replace with the product ID for your software
    $serviceId = $vars['params']['serviceid'];

    if ($vars['params']['type'] == 'product' && $vars['params']['productid'] == $productId) {
        // Generate a license key
        $licenseKey = generateLicenseKey();

        // Save the license key to the database
        saveLicenseKey($serviceId, $licenseKey);

        // Provide the license key to the user
        // You may send an email, display it on the thank-you page, etc.
        // For demonstration purposes, let's store it in session and display a message on the client area
        $_SESSION['license_key'] = $licenseKey;
        // (Optional) You can customize the success message and redirect URL
        $vars['success'] = true;
        $vars['message'] = "Your license key: " . $licenseKey;
        $vars['redirect'] = "clientarea.php?action=services"; // Redirect to client's services page
    }
}

function custom_license_generator_InvoicePaid($vars)
{
    // Check if the invoice belongs to the product in question (using product ID)
    $productId = 123; // Replace with the product ID for your software
    $invoiceId = $vars['invoiceid'];
    $serviceId = $vars['relid'];

    $invoiceItems = localAPI('GetInvoice', ['invoiceid' => $invoiceId]);
    $relatedServiceId = $invoiceItems['items']['item'][0]['relid'];

    if ($relatedServiceId != $serviceId) {
        return; // The paid invoice doesn't belong to our product
    }

    // Reactivate the license key or update its status if needed
    // Implement your custom logic here, based on the payment status
    updateLicenseExpiryStatus($serviceId, '0'); // Set the license status to active (not expired)
}

function custom_license_generator_ServiceCancel($vars)
{
    // Check if the canceled service belongs to the product in question (using product ID)
    $productId = 123; // Replace with the product ID for your software
    $serviceId = $vars['params']['serviceid'];

    if ($vars['params']['type'] == 'product' && $vars['params']['productid'] == $productId) {
        // Implement your custom logic to handle the cancellation of the product/service
        // For example, you can mark the license key as expired in the database
        updateLicenseExpiryStatus($serviceId, '1'); // Set the license status to expired
    }
}
