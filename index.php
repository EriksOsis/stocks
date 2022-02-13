<?php


require_once('C:/Users/daina/Desktop/money/vendor/autoload.php');

$config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c83cnhiad3ift3bm6ue0');
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $config
);

if (isset($_GET["search"])) {
    try {
        $symbol = $client->quote($_GET["search"]);
    } catch (\Finnhub\ApiException $e) {
    }
}

$tickers = ["TSLA", "COIN", "AMZN", "FB",];

?>

<html>
<head>
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BigMoney</title>

    <style>
        main {
            display: flex;
            flex-wrap: wrap;
            text-align: center;

        }

        div {
            border: solid black 5px;
            margin: 5px
        }

        .green {
            color: green;
        }

        .red {
            color: red;
        }

    </style>
</head>
<body>
    <?php foreach ($tickers as $stock): ?>
    <?php $s = $client->quote($stock); ?>
    <main>
        <section>
            <div>
                <p><?php echo $stock . ": "; echo $s["c"] . "$"; ?></p>
                <p>Previous Close Price: <?= $s["pc"] . "$"; ?></p>
                <p>Open Price Of The Day: <?= $s["o"] . "$"; ?></p>
                <?php if ($s["dp"] > 0): ?>
                    <p class="green">  Percent change: <?= $s["dp"]; ?></p>
                <?php else: ?>
                    <p class="red"> Percent change: <?= $s["dp"]; ?></p>
                <?php endif; ?>
                <?php if ($s["d"] > 0): ?>
                    <p class="green"> Change: <?= $s["d"]; ?></p>
                <?php else: ?>
                    <p class="red"> Change: <?= $s["d"]; ?></p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php endforeach; ?>
</body>
</html>
