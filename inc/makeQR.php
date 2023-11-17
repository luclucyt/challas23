<?php

require "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\Font;
use Endroid\QrCode\RoundBlockSizeMode;

class MakeQR{
    private $text;
    private $label;
    private $email;

    public function __construct($text, $label, $email){
        $this->text = $text;
        $this->label = $label;
        $this->email = $email;
    }

    public function create(){
        $qr_code = QrCode::create($this->text)
                 ->setSize(600)
                 ->setMargin(40)
                 ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);


        if($this->label != null){
            $label = Label::create($this->label)
              ->setTextColor(new Color(167, 205, 72))
              ->setAlignment(new LabelAlignmentLeft)
              ->setFont(new Font(
                  'CenturyGothicPro-Bold.otf',
              ));
        }

      

        $writer = new PngWriter;
        $result = $writer->write($qr_code, label: $label);

        $result->saveToFile("../IMG/qr/".$this->email.".png");
    }
}