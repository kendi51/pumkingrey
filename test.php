// <?php

//     $to = "olwethuntsukumbini@pumkingrey.com";
//     $subject = "Thank you for your purchase: PumkinGrey";
    
//     $header = array(
//         "MIME-Version" => "1.0",
//         "Content-Type" => "text/html; charset=UTF-8",
//         "From" => "nonreply@pumkingrey.com",
//         "Reply-To" => "olwethu@pumkingrey.com"
//     );
//     $id = 215;
//     ob_start();    
//     include("email/email.php");
//     $message = ob_get_contents();
//     ob_get_clean();
    
//     $send = mail($to, $subject, $message, $header);
    
//     echo ($send ? "Mail is sent" : "There is an error");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Share Button</title>
    <style>
        .share-button {
            display: flex;
            align-items: center;
        }
        .share-button img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="share-button">
        <img src="facebook.png" alt="Facebook" class="share-icon">
        <img src="twitter.png" alt="Twitter" class="share-icon">
        <img src="linkedin.png" alt="LinkedIn" class="share-icon">
        <img src="instagram.png" alt="Instagram" class="share-icon">
    </div>

    <script>
        // Function to open the share URL in a new window
        function share(url) {
            window.open(url, '_blank', 'width=600,height=400');
        }

        // Add click event listeners to each social media icon
        const shareIcons = document.getElementsByClassName('share-icon');
        for (let i = 0; i < shareIcons.length; i++) {
            shareIcons[i].addEventListener('click', function() {
                const socialMedia = this.alt.toLowerCase();
                const urlToShare = 'https://www.example.com'; // Replace with your desired URL to share

                switch (socialMedia) {
                    case 'facebook':
                        share('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(urlToShare));
                        break;
                    case 'twitter':
                        share('https://twitter.com/intent/tweet?url=' + encodeURIComponent(urlToShare));
                        break;
                    case 'linkedin':
                        share('https://www.linkedin.com/shareArticle?url=' + encodeURIComponent(urlToShare));
                        break;
                    case 'instagram':
                        share('https://www.instagram.com/');
                        break;
                }
            });
        }
    </script>
</body>
</html>
