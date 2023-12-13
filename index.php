<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

for ($i = 0; $i < count($hotels); $i++) {
    $hotels[$i]['distance_to_center'] .= ' km';
    $hotels[$i]['parking'] = $hotels[$i]['parking'] ? 'Yes' : 'No';
    $hotels[$i]['vote'] .= ' / 5';
}

function filterHotels($parking_value, $vote_value) {
    if (empty($_GET['vote']) && empty($_GET['parking'])) {
        return '';
    } elseif ($parking_value != $_GET['parking'] && !empty($_GET['parking'])) {
        return 'd-none';
    } elseif ($vote_value < $_GET['vote']) {
        return 'd-none';
    }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom style -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container">

        <h2 class="text-center mb-4 mt-4">Filters</h2>
        <form class="d-flex justify-content-around align-items-end" action="index.php">
            <div>
                <label for="parking">Filter for parking</label>
                <select class="form-select form-select-sm" name="parking" id="parking">
                    <option value=""></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div>
                <label for="vote">Filter for vote</label>
                <select class="form-select form-select-sm" name="vote" id="vote">
                    <option value=""></option>
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-dark" type="submit">FILTER</button>
        </form>

        <hr class="m-5">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">HOTELS</th>
                    <?php foreach ($hotels[0] as $key => $value) { ?>
                        <th scope="col"><?= str_replace('_', ' ', Ucwords($key)) ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $i => $hotel) { ?>
                    <tr class="<?= filterHotels($hotel['parking'], $hotel['vote']); ?>">
                        <th scope="row"><?= $i ?></th>
                        <?php foreach ($hotel as $value) { ?>
                            <td><?= $value; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>