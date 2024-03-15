<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Kursi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container-seat {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: 75vh;
      margin: 0;
    }

    .row {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
    }

    .seat {
      width: 40px;
      height: 40px;
      border: 1px solid #ccc;
      position: relative;
    }

    .seat input[type="checkbox"] {
      display: none;
    }

    .seat input[type="checkbox"]:checked + label,
    .seat input[type="checkbox"]:checked {
      background-color: yellow;
      color: #fff;
      border-color: black;
    }

    .seat.ordered {
      background-color: red;
      cursor: not-allowed;
    }

    .seat label {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>
</head>
<body>

<div class="container-seat">

  <h2>Pilih Kursi</h2>

  <?php
    // Daftar kursi yang sudah diorder (misalnya dari database atau sumber data lainnya)
    $orderedSeats = ['C4'];

    $rows = range('A', 'G');
    $seatsPerRow = 10;

    foreach ($rows as $row) {
  ?>
      <div class="row">
        <?php
          for ($seatNumber = 1; $seatNumber <= $seatsPerRow; $seatNumber++) {
            $seatId = $row . $seatNumber;
            $isOrdered = in_array($seatId, $orderedSeats);
        ?>
            <div class="seat <?php echo $isOrdered ? 'ordered' : ''; ?>">
              <input type="checkbox" id="<?php echo $seatId; ?>" name="seat[]" value="<?php echo $seatId; ?>" <?php echo $isOrdered ? 'disabled' : ''; ?>>
              <label for="<?php echo $seatId; ?>"><?php echo $seatId; ?></label>
            </div>
        <?php
          }
        ?>
      </div>
  <?php
    }
  ?>
<div class="d-flex">
  <a class="btn btn-primary mr-2" href="">Booking</a> <!-- mr-2 menambahkan margin kanan sebesar 2 unit -->
  <a class="btn btn-secondary" href="">Back</a>
</div>

</div>

</body>
</html>
