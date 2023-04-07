<?php
 require('rotation.php');

    class PDF extends PDF_Rotate{
            protected $_outerText1;// dynamic text
        protected $_outerText2;

        function setWaterText($txt1="", $txt2=""){
            $this->_outerText1 = $txt1;
            $this->_outerText2 = $txt2;
        }

        function Header(){
            //Put the watermark
            $this->SetFont('Arial','B',65);
            $this->SetTextColor(255,102,102);
                    $this->SetAlpha(0.8);
            $this->RotatedText(40,260, $this->_outerText1, 55);
            $this->RotatedText(75,190, $this->_outerText2, 45);
        }

        function RotatedText($x, $y, $txt, $angle){
            //Text rotated around its origin
            $this->Rotate($angle,$x,$y);
            $this->Text($x,$y,$txt);
            $this->Rotate(0);
        }
    }

 





    



?>