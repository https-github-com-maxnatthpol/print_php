<?php
header('Access-Control-Allow-Origin: *');

if (isset($_POST['print'])) {
	if ($_POST['print'] == "printslip_return_card") {
		printslip_return_card();
		exit;
	}
}

function printslip_return_card()
{
  $printer = '\\\\'.$_POST["ip"].'\\'.$_POST["printname"];
  if($handle = printer_open($printer)){

      printer_set_option($handle, PRINTER_COPIES, 1);
      printer_set_option($handle, PRINTER_MODE, 'text');
      printer_set_option($handle, PRINTER_TITLE, 'my first doc');
      printer_set_option($handle, PRINTER_SCALE, 100);
      printer_set_option($handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_PORTRAIT);
      printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A4);

      printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_LEFT);

      printer_start_doc($handle, "My Document");
      printer_start_page($handle);

      $font = printer_create_font("TH Sarabun New", dpimm2px(2), dpimm2px(0), PRINTER_FW_NORMAL, false, false, false, 0);
      printer_select_font($handle, $font);
      $text = "FoodCourt";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(7));
      $text = "TAX 0000000000000 (".$_POST["data"].")";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(11));
      $text = "ใบเสร็จรับเงิน/ใบกำกับภาษีอย่างย่อ";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(19));

      $text = "---------------------------------------------------";
      $text = iconv("UTF-8","TIS-620",$text);
      printer_draw_text($handle, $text, dpimm2px(0.1), dpimm2px(27));


      printer_delete_font($font);

      printer_end_page($handle);
      printer_end_doc($handle);
      printer_close($handle);
  }else{
      echo "Connot connect to: ".$printer;
  }
}

function dpimm2px($val,$dpi=600){
    return ((($dpi*0.393701)/10)*$val);
}
?>
