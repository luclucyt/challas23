<?php

require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

$text = "Hello World!";

$qr_code = QrCode::create($text)
                 ->setSize(600)
                 ->setMargin(40)
                 ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);

$label = Label::create("Lucas van Briemen")
              ->setTextColor(new Color(255, 0, 0))
              ->setAlignment(new LabelAlignmentLeft);


$writer = new PngWriter;

$result = $writer->write($qr_code, label: $label);

// Output the QR code image to the browser
header("Content-Type: " . $result->getMimeType());

echo $result->getString();

// Save the image to a file
$result->saveToFile("qr-code.png");
