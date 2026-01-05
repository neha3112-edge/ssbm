<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'response' => 'error',
        'message'  => 'POST is required'
    ]);
    exit;
}

/* ===============================
   1. COLLECT FORM DATA
================================ */
$full_name     = $_POST['full_name'] ?? '';
$email         = $_POST['email'] ?? '';
$phone         = $_POST['phone'] ?? '';
$course        = $_POST['course'] ?? '';
$state         = $_POST['state'] ?? '';
$source        = $_POST['source'] ?? '';
$sub_source    = $_POST['sub_source'] ?? '';
$utm_source    = $_POST['utm_source'] ?? '';
$utm_campaign  = $_POST['utm_campaign'] ?? '';
$utm_medium    = $_POST['utm_medium'] ?? '';
$utm_term      = $_POST['utm_term'] ?? '';
$page_url      = $_POST['page_url'] ?? '';
$show_brochure = $_POST['show_brochure'] ?? 'no';

/* ===============================
   2. PREPARE COMMON DATA
================================ */
$lead_data = [
    'full_name'    => $full_name,
    'name'         => $full_name, // for CRM
    'email'        => $email,
    'phone'        => $phone,
    'course'       => $course,
    'state'        => $state,
    'source'       => $source,
    'sub_source'   => $sub_source,
    'utm_source'   => $utm_source,
    'utm_campaign' => $utm_campaign,
    'utm_medium'   => $utm_medium,
    'utm_term'     => $utm_term,
    'page_url'     => $page_url
];

/* ===============================
   3. SEND TO CRM (JSON)
================================ */
$crm_url = 'https://api.crm.mysode.com/api/lead/apicreated';
$crm_api_key = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $crm_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($lead_data),
    CURLOPT_HTTPHEADER => [
        "x-api-key: {$crm_api_key}",
        "Content-Type: application/json"
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10
]);

$crm_response = curl_exec($ch);
if (curl_errno($ch)) {
    error_log('CRM Error: ' . curl_error($ch));
}
curl_close($ch);

/* ===============================
   4. SEND TO GOOGLE SHEET (JSON – FIXED)
================================ */
$sheet_url = 'https://script.google.com/macros/s/AKfycbzSOEabwc16HTdMnfxdxFuOoEouHyLDSNwId7rRh6MoGdW4Wm29crpXOgdqOeSw3xZy/exec';

$sheet_data = [
    'full_name'    => $full_name,
    'email'        => $email,
    'phone'        => $phone,
    'course'       => $course,
    'state'        => $state,
    'source'       => $source,
    // 'sub_source'   => $sub_source,
    // 'utm_source'   => $utm_source,
    // 'utm_campaign' => $utm_campaign,
    // 'utm_medium'   => $utm_medium,
    // 'utm_term'     => $utm_term,
    'page_url'     => $page_url,
    'website'      => 'SSBM' // 👈 TAB NAME IN GOOGLE SHEET
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $sheet_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($sheet_data),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10
]);
curl_exec($ch);
curl_close($ch);

/* ===============================
   5. SEND TO PABBLY
================================ */
$pabbly_url = 'https://connect.pabbly.com/workflow/sendwebhookdata/IjU3NjUwNTZhMDYzNDA0MzI1MjY4NTUzMzUxMzAi_pc';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $pabbly_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($lead_data),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10
]);
curl_exec($ch);
curl_close($ch);

/* ===============================
   6. REDIRECT USER
================================ */
if ($show_brochure === 'yes') {
    header("Location: thank-you.php?course=" . urlencode($course));
} else {
    header("Location: thank-you.php");
}
exit;