<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- Dynamically generate page title based on current uri and format the output -->
<title>ProfielPlus<?= ($_SERVER['REQUEST_URI'] === '/') ? '' : ' • ' . ucfirst(trim($_SERVER['REQUEST_URI'], '/')) ?></title>
<link rel="stylesheet" href="views/partials/css/main.css" />
<link rel="stylesheet" href="views/partials/header/header.css" />
<link rel="stylesheet" href="views/partials/footer/footer.css" />
<script src="views/partials/header/header.js" async></script>