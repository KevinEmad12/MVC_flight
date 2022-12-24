    <?php
        // Create connection
        $conn = new mysqli("localhost", "root", "", "egway");
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT FlightCode, FromAirPort, Destination, TripStatus FROM trips WHERE trips.FlightCode='".$_GET['FCode']."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo"<div class='FlightCardTopBar'></div>";
            echo"<div class='FlightCard'>";
            echo"<div style='text-align: center;'>Flight Details</div>";
            echo "<span style='text-align: left;'> Flight Code: " . $row["FlightCode"]."</span>";
            echo "<span style='float:right;'> TripStatus: " . $row["TripStatus"]."</span>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<span style='text-align: left;'> Destination: " . $row["Destination"]."</span>";
            echo "<span style='float:right;'> FromAirPort: " . $row["FromAirPort"]."</span>";
            echo "</div>";
          }
        } else {
          echo "<div style='font-size:40px;color:Red;'><br>Flight Code not Found</div>";
        }
        $conn->close();
    ?>
