<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceptation de Demande de Stage</title>
</head>
<body>
    <p>Bonjour <?php echo e($prenom); ?> <?php echo e($nom); ?>,</p>

    <p>Nous avons le plaisir de vous informer que votre demande de stage a été acceptée.</p>

    <p>Voici les détails de votre stage :</p>
    <ul>
        <li><strong>Service :</strong> <?php echo e($service); ?></li>
        <li><strong>Date de début :</strong> <?php echo e($date_debut); ?></li>
        <li><strong>Date de fin :</strong> <?php echo e($date_fin); ?></li>
    </ul>

    <p>Nous sommes ravis de vous accueillir au sein de notre équipe et nous espérons que cette expérience sera enrichissante pour vous.</p>

    <p>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>

    <p>Cordialement,</p>
    <p>L'équipe RH</p>
</body>
</html><?php /**PATH C:\Users\lekou\OneDrive\Desktop\Stage\Stage\resources\views/emails/accept-demande-stage.blade.php ENDPATH**/ ?>