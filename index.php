<?php
declare(strict_types=1);
require_once __DIR__ . '/inc/api.php';
$city = isset($_GET['city']) ? trim($_GET['city']) : 'Barrie';
$country = isset($_GET['country']) ? trim($_GET['country']) : 'CA';
$data = null;
$error = null;
if ($city !== '') {
    try {
        $data = get_current_weather($city, $country);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Weather Now</title>
  <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
  <header><h1>Weather Now</h1></header>
  <main>
    <form method="get">
      <label>City: <input name="city" value="<?php echo htmlspecialchars($city); ?>"></label>
      <label>Country: <input name="country" value="<?php echo htmlspecialchars($country); ?>"></label>
      <button type="submit">Get Weather</button>
    </form>
    <?php if ($error): ?>
      <p>Error: <?php echo htmlspecialchars($error); ?></p>
    <?php elseif ($data): ?>
      <h2><?php echo htmlspecialchars($data['name']); ?></h2>
      <p><?php echo round($data['main']['temp']); ?>°C</p>
      <p><?php echo htmlspecialchars($data['weather'][0]['description']); ?></p>
    <?php endif; ?>
  </main>
</body>
</html>