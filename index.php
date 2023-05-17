<?php
$accessToken = 'IGQVJYODNOdVp5OHJlTk1sd3hMQmx6a09ObWt2NHVwNGZANNURnZAHlYazlKS2o0cWVVT29WMk9xSjBTMk92MHd0dFFJM0syRHNsaHlHMzktQlhINjY1SV9tc1BGb2J0RndHVW9LcElzaFVPSVg1X0UwRQZDZD'; // Ganti dengan access token Anda
$userId = '5988100287905652'; 

$url = "https://graph.instagram.com/{$userId}/media?fields=id,caption,media_type,media_url&access_token={$accessToken}";

$link = "https://graph.instagram.com/me?fields=username&access_token={$accessToken}";

$respon = file_get_contents($link);
$name = json_decode($respon, true);
// var_dump($name);
if (isset($name['username'])) {
    $username = $name['username'];
    $usernameMessage = $username;
} else {
    $usernameMessage = 'Gagal mendapatkan username dari Instagram API.';
}



$response = file_get_contents($url);
$data = json_decode($response, true);

if (isset($data['data'])) {
    $images = $data['data'];
} else {
    $images = [];
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Instagram Data API</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
            text-align: center;
        }

        .username {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .image-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .image-container img {
            width: 200px;
            height: 200px;
            margin: 10px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Instagram Data API</h1>
        <div class="username"><?php echo "Username : " . $usernameMessage; ?></div>
        <div class="image-container">
            <?php
            foreach ($images as $post) {
                $mediaUrl = $post['media_url'];
                echo '<img src="' . $mediaUrl . '" alt="Instagram Image">';
            }
            ?>
        </div>
    </div>
    
    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>