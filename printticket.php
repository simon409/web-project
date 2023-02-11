<?php
ob_start();

require('./config/config.php');
require_once('./config/fpdf.php');


$idt = $_GET['idt'];

$query = "SELECT cmd.*, f.froma, f.toa, f.boardtime, f.arrivaltime, u.fullname, c.namecoun as 'fromcoun', c.codecoun as 'fromcode', c1.namecoun as 'tocoun', c1.codecoun as 'tocode', TIMEDIFF(f.arrivaltime,f.boardtime) as 'duration', a.nameairp as 'fromair', a.codeairport as 'fromaircode' , a1.nameairp as 'toair', a1.codeairport as 'toaircode' from flights f, airport a, airport a1, country c, country c1, commandedf cmd, users u where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and ((f.flightnum=cmd.flightnum and cmd.iduser = u.id) and cmd.id = $idt);";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $flight_number = $row["flightnum"];
        $departure = $row["fromcoun"];
        $departurecode = $row["fromaircode"];
        $arrival = $row["tocoun"];
        $arrivalcode = $row["toaircode"];
        $departure_time = $row["boardtime"];
        $arrival_time = $row["arrivaltime"];
        $passenger_name = $row["fullname"];
        $num_adt = $row['numt_adult'];
        $num_cld = $row['numt_child'];
        $date = $row['date'];
        $qrcode = $row['qrcode'];
        $price = $row['totalprice'];
    }
} else {
    echo "0 results";
}

class PDF extends FPDF
{
    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

    function Header()
    {
        // Logo
        $this->SetFont('helvetica','',15);
        $this->Image('./assets/logofly.png',10,10,40);
        // Arial bold 15
        $this->SetFont('helvetica','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,70,'Your Flight E-Ticket',0,0,'C');
        $this->ln(50);
    }

    function FlightDetails($flight_number, $departure, $departurecode, $arrival, $arrivalcode, $departure_time, $arrival_time)
    {
        // Arial 12
        $this->SetFont('helvetica','B',12);
        // Flight Number
        $this->Cell(170,10,'Flight Number: '.$flight_number,0,0,'R');
        $this->ln(1);
        // Departure
        $this->Cell(40,10,'Departure: '.$departure.' ('.$departurecode.')',0,1);
        // Arrival
        $this->Cell(40,10,'Arrival : '.$arrival.' ('.$arrivalcode.')',0,1);
        // Departure Time
        $this->Cell(40,10,'Departure Time: '.$departure_time,0,1);
        // Arrival Time
        $this->Cell(40,10,'Arrival Time: '.$arrival_time,0,1);
    }

    function PassengerDetails($passenger_name)
    {
        // Arial 12
        $this->SetFont('helvetica','B',12);
        // Passenger Name
        $this->Cell(150,10,'Passenger Name: '.$passenger_name,0,0);
        $this->ln(15);
    }

    function Price($price){
       // Arial 12
       $this->SetFont('helvetica','B',12);
       $this->Cell(80);
       // Passenger Name
       $this->Cell(30,10,'Total Price: ',0,1, 'C');

        $this->ln(1);

       $this->Cell(80);
       $this->SetFont('helvetica','B',16);
       $this->SetTextColor(230, 57, 70);
       // Passenger Name
       $this->Cell(30,10,$price.' DH',0,0, 'C');
       
    }

    function QrCodegenerated($qrcode, $departure, $arrival, $departurecode, $arrivalcode, $num_adt, $num_cld, $date, $boardtime){
        // Arial italic 8
        $this->SetFont('helvetica','B',14);

        $this->SetFillColor(255,255,255);

        $this->RoundedRect(30, 150, 150, 80, 5, '1234', 'DF');

        // Logo
        $this->SetFont('helvetica','',15);
        $this->Image('./assets/qrimages/'.$qrcode,35,160,60);
        $this->ln(5);

        $this->SetTextColor(29, 53, 87);

         // Arial 12
         $this->SetFont('helvetica','B',12);
         $this->Cell(85);
         // Flight Number
         $this->Cell(110,70,$departure.'->'.$arrival,0,0);
         $this->ln(40);
         $this->Cell(85);
         $this->Cell(120,10, $departurecode.'->'.$arrivalcode,0,1);
         
         $this->Cell(85);
         $this->Cell(120,10,'Num ticket adult: '.$num_adt,0,1);
         
         $this->Cell(85);
         $this->Cell(120,10,'Num ticket child: '.$num_cld,0,1);
         
         $this->Cell(85);
         $this->Cell(120,10,'Flight Date: '.$date,0,1);
         
         $this->Cell(85);
         $this->Cell(120,8,'Flight Number: '.$boardtime,0,1);

    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('helvetica','B',14);

        $this->SetFillColor(238,238,238);
        //RoundedRect(Position x, position y, width, height, border-radius, borders '1234' 1:top-left 2:top-right 3:bottom-left 4:bottom-right, F or D or both f:filled, d: drawn-borders)
        $this->RoundedRect(0, 267, 210, 30, 0, '12', 'F');

        $this->SetFillColor(255,255,255);
        $this->RoundedRect(0, 257, 210, 20, 5, '34', 'F');

        $this->SetTextColor(112,112,112);
        // Page number
        $this->Cell(0,10,'Fly.Me - All rights reserved '.date('Y'),0,0,'C');
    }
}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('You Fly.Me Ticket for a flight from : '.$departure.' to : '.$arrival);
$pdf->SetFont('helvetica','',10);
$pdf->FlightDetails($flight_number, $departure, $departurecode, $arrival, $arrivalcode, $departure_time, $arrival_time);
$pdf->PassengerDetails($passenger_name);
$pdf->Price($price);
$pdf->QrCodegenerated($qrcode, $departure, $arrival, $departurecode, $arrivalcode, $num_adt, $num_cld, $date, $departure_time);
$pdf->Output();

?>