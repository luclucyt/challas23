<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/admin.css">

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/qrRead.js" type="module" defer></script>
</head>

<body>
    <video id="preview"></video>

    <select class="admin-type">
        <option value="eten">eten</option>
        <option value="drinken">drinken</option>
        <option value="activiteit">activiteit</option>
    </select>
</body>

</html>