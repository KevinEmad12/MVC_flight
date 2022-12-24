<html>
<link rel="stylesheet" href="Styles\Styles.css">
<?php
    session_start();
?>
<Ul style="border: 3px solid; list-style: none; font-size:30px; text-align: left; position:fixed; top: 0%; right: 0%; background-color: white; padding:10px; ">
    <li>Search Details</li>
    <li>Trip type:<?php echo"<span id='TripType'>".$_GET['TripType']."</span>"; ?></li>
    <li>From:<?php echo"<span id='From'>".$_GET['From']."</span>"; ?></li>
    <li>To:<?php echo"<span id='To'>".$_GET['To']."</span>"; ?></li>
    <li>Passengers:<?php echo"<span id='NumberOfPassengers'>".$_GET['NumberOfPassengers']."</span>"; ?></li>
    <li>Date:<?php if(isset($_GET['date'])){ echo"<span id='Date'>".$_GET['date']."</span>"; } ?></li>
</ul>
<table style="border-collapse: collapse; font-size:20px; text-align: center; position:fixed; bottom: 0%; right: 0%; background-color: white; padding:10px; ">
    <tr style="border: 3px solid;">
    <th style="border: 3px solid;">Flight Code</th>
    <th style="border: 3px solid;">Count</th>
    <th style="border: 3px solid;">Price</th>
    </tr>
    <tr style="border: 3px solid;">
    <?php if(isset($_GET['FCode'])){echo"<td style='border: 3px solid;'><span id='f_code'>".$_GET['FCode']."</span></td><td style='border: 3px solid;'><span id='nump'>".$_GET['NumberOfPassengers']."</span></td><td style='border: 3px solid;'><span id='P1'></span></td>"; } ?>
    </tr>
    <tr style="border: 3px solid;">
    <?php if(isset($_GET['FCode2'])){echo"<td style='border: 3px solid;'><span id='f_code2'>".$_GET['FCode2']."</span></td><td style='border: 3px solid;'><span>".$_GET['NumberOfPassengers']."</span></td><td style='border: 3px solid;'><span id='P2'></span></td>"; } ?>
    </tr>
    <tr style="border: 3px solid;">
        <?php echo"<td style='border: 3px solid;'><span>Total Price</span></td><td>=</td><td style='border: 3px solid;'><span id='TP'></span></td>"; ?>
    </tr>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    window.onload = function() {
        GetPrice();
    };
    function GetPrice(){
        jQuery.ajax(
        {
            url:"GetPrice.php",
            data:"FCode="+document.getElementById('f_code').innerHTML,
            type:"GET",
            success:function(data)
            {
                document.getElementById('P1').innerHTML=data*document.getElementById('nump').innerHTML;
                document.getElementById('TP').innerHTML=data*document.getElementById('nump').innerHTML;
            }
        }
        );
        jQuery.ajax(
        {
            url:"GetPrice.php",
            data:"FCode="+document.getElementById('f_code2').innerHTML,
            type:"GET",
            success:function(data)
            {
                document.getElementById('P2').innerHTML=data*document.getElementById('nump').innerHTML;
                document.getElementById('TP').innerHTML+=data*document.getElementById('nump').innerHTML;
            }
        }
        );
    }
    function convert(str) {
  var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
  return [date.getFullYear(), mnth, day].join("-");
}
    function AddToCart(Flight) {
        let str="";
        if(document.getElementById('Date').innerHTML!="")
        {
            let str =document.getElementById('Date').innerHTML;
            let dat = new Date();
            dat.setDate(dat.getDate()+7);
            alert(convert(dat));
        }
        let FC1;
        let FC2;
        let FC3;
        if(document.getElementById('f_code2')!=null)
        {
            FC1=document.getElementById('f_code').innerHTML;
            FC2=document.getElementById('f_code2').innerHTML;
            FC3=Flight;
        }
        else if(document.getElementById('f_code')!=null)
        {
            FC1=document.getElementById('f_code').innerHTML;
            FC2=Flight;
            FC3="";
        }
        else
        {
            FC1=Flight;
            FC2="";
            FC3="";
        }
        if(document.getElementById('TripType').innerHTML=='Direct')//Completed direct flight
        {
            jQuery.ajax(
            {
                url:"AddToCart.php",
                data:"FCode="+FC1+"&NumOfPassengers="+document.getElementById('NumberOfPassengers').innerHTML+"&FCode2="+FC2+"&FCode3="+FC3,
                type:"GET",
                success:function(data)
                {
                    alert("Successfully Booked");                        
                }
            }
        );
            location.href = "Cart.php";
        }
        if(document.getElementById('TripType').innerHTML=='ReturnEarly')
        {
            let From=document.getElementById('To').innerHTML;
            let To=document.getElementById('From').innerHTML;
            let NumP=document.getElementById('NumberOfPassengers').innerHTML;
            location.href = "Trips.php?From="+From+"&To="+To+"&TripType=Direct&NumberOfPassengers="+NumP+"&FCode="+Flight+"&date="+str+"&T=b";
        }
        if(document.getElementById('TripType').innerHTML=='ReturnLate')
        {
            let From=document.getElementById('To').innerHTML;
            let To=document.getElementById('From').innerHTML;
            let NumP=document.getElementById('NumberOfPassengers').innerHTML;
            location.href = "Trips.php?From="+From+"&To="+To+"&TripType=Direct&NumberOfPassengers="+NumP+"&FCode="+Flight+"&date="+str+"&T=a";
        }
        if(document.getElementById('TripType').innerHTML=='Transit')
        {
            let From=document.getElementById('From').innerHTML;
            let To=document.getElementById('To').innerHTML;
            let NumP=document.getElementById('NumberOfPassengers').innerHTML;
            location.href = "Trips.php?From="+From+"&To="+To+"&TripType=Direct&NumberOfPassengers="+NumP+"&FCode="+FC1+"&state=mid&date=";
        }
        if(document.getElementById('TripType').innerHTML=='Multiple')
        {
            let From=document.getElementById('To').innerHTML;
            let To=document.getElementById('From').innerHTML;
            let NumP=document.getElementById('NumberOfPassengers').innerHTML;
            if(document.getElementById('f_code')==null)
                location.href = "Trips.php?From="+From+"&To="+To+"&TripType=Multiple&NumberOfPassengers="+NumP+"&FCode="+FC1+"&date=";
            else
                location.href = "Trips.php?From="+From+"&To="+To+"&TripType=Direct&NumberOfPassengers="+NumP+"&FCode="+FC1+"&FCode2="+FC2+"&date=";
        }
    }
</script>
<?php
    // Create connection
    $conn = new mysqli("localhost", "root", "", "egway");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['T']))//for return late/Early
    {
        if($_GET['T']=='b')
            $sql = "SELECT FlightCode, FromAirPort, Destination, f_date, price FROM trips WHERE FromAirPort='".$_GET['From']."' AND Destination='".$_GET['To']."'";
        if($_GET['T']=='a')
            $sql = "SELECT FlightCode, FromAirPort, Destination, f_date, price FROM trips WHERE FromAirPort='".$_GET['From']."' AND Destination='".$_GET['To']."'";
    }

    if($_GET['date']!=NULL)//if date is set
        $sql = "SELECT FlightCode, FromAirPort, Destination, f_date, price FROM trips WHERE FromAirPort='".$_GET['From']."' AND Destination='".$_GET['To']."' AND f_date='".$_GET['date']."'";
    else//if date is not set
        $sql = "SELECT FlightCode, FromAirPort, Destination, f_date, price FROM trips WHERE FromAirPort='".$_GET['From']."' AND Destination='".$_GET['To']."'";

    if($_GET['TripType']=='Transit')//transit flights1
    {
    $sql="SELECT * FROM `trips` WHERE `FromAirPort`='".$_GET['From']."' AND `Destination`IN (SELECT `FromAirPort` FROM `trips` WHERE `Destination`= '".$_GET['To']."')";
    }

    if(isset($_GET['state']))//transit flights2
    {
        $sql="SELECT * FROM `trips` WHERE `Destination`='".$_GET['To']."' AND `FromAirPort` = (SELECT `Destination` FROM `trips` WHERE `FlightCode`='".$_GET['FCode']."')";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output flight cards
        while($row = $result->fetch_assoc()) {
        echo"<div class='FlightCardTopBar'> <input id=". $row['FlightCode']." type='button' onclick='AddToCart(this.id)' value='Book' class='right'></div>";
        echo"<div class='FlightCard'>";
        echo"<div style='text-align: center;'>Flight Details</div>";
        echo "<span style='text-align: left;'> Flight Code:".$row['FlightCode']."</span>";
        echo "<span style='float:right;'> TripDate: " . $row["f_date"]."</span>";
        echo "<br>";
        echo "<br>";
        echo "<span style='text-align: left;'> Destination: " . $row["Destination"]."</span>";
        echo "<span style='float:right;'> FromAirPort: " . $row["FromAirPort"]."</span>";
        echo "<br>";
        echo "<div style='text-align: center;'> Price: " . $row["price"]."</div>";
        echo "</div>";
        echo "<br>";
        }
    } else {
      echo "No Flights Found";
    }
    $conn->close();
?>
</html>