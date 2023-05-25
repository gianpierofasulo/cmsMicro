<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_contabilita.php';
           
            $id_esercente = filter_input(INPUT_POST, 'ide', FILTER_SANITIZE_NUMBER_INT );
            $id_macchina = filter_input(INPUT_POST, 'idm', FILTER_SANITIZE_NUMBER_INT );
			$body_contabilita_motori = '';
          
            $contabilita = new Contabilita;
    
            if ($id_esercente && $id_macchina) {
            $dati_contabilita = $contabilita->carica_contabilita($id_esercente, $id_macchina);

            $dati_contabilita_motori = $contabilita->carica_contabilita_motori($id_esercente, $id_macchina);

            $incasso = $dati_contabilita["incasso"] / 100 ;
			$incasso_monete = $dati_contabilita["incasso_monete"] / 100;
			$incasso_banconote = $dati_contabilita["incasso_banconote"] / 100;
			$incasso_pos = $dati_contabilita["incasso_pos"] / 100;
			$incasso_cashless = $dati_contabilita["incasso_cashless"] / 100;
			$incasso_scontrino = $dati_contabilita["incasso_scontrino"] / 100;
			$resto_scontrino = $dati_contabilita["resto_scontrino"] / 100;
			$resto_monete = $dati_contabilita["resto_monete"] / 100;
			$resto_totale = $dati_contabilita["resto_totale"] / 100;
			$totale_venduto = $dati_contabilita["totale_venduto"] / 100;
			$azzeramento = $dati_contabilita["azzeramento"];
			
			

            foreach( $dati_contabilita_motori as $row_contabilita_motori) {
                $incasso2 = $row_contabilita_motori["incasso"] / 100;
				$titolo_prodotto = $row_contabilita_motori["titolo_prodotto"];
				$alias = $row_contabilita_motori["alias"];  
                
				$body_contabilita_motori .= "<tr><td>$alias</td><td>$titolo_prodotto</td><td  align='right'>$incasso2</td></tr>";
                
            }
        } else {
            die('DATI MANCANTI');
        }


// invio l'email 
            // creo il template email
			$headeremail = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			</head>
			<body>
			<table align='center' style='border: 1px solid #CCCCCC;'>
			<tr><td  align='center' colspan='2' style='border-bottom: 1px solid #CCCCCC;'>
      		SITUAZIONE CONTABILITA'      
      		</td>
      		</tr>";
      		
      		$bodyemail = "<tr bgcolor='#CCCCCC'><td colspan='2' align='center'>GENERALE</td></tr>";
			$bodyemail .= "<tr style='border: 1px solid #CCCCCC;'><td colspan='1'>INDICATORI</td><td colspan='1' align='right'>TOTALI</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>INCASSO TOTALE</td><td colspan='1'  align='right'>$incasso</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>INCASSO (MONETA)</td><td colspan='1'  align='right'>$incasso_monete</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>INCASSO (BANCONOTA)</td><td colspan='1'  align='right'>$incasso_banconote</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>INCASSO (CASHLESS)</td><td colspan='1'  align='right'>$incasso_cashless</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>INCASSO (POS)</td><td colspan='1'  align='right'>$incasso_pos</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>INCASSO (TICKET)</td><td colspan='1'  align='right'>$incasso_scontrino</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>RESTO SCONTRINO</td><td colspan='1'  align='right'>$resto_scontrino</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>RESTO MONETA</td><td colspan='1'  align='right'>$resto_monete</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>RESTO TOTALE (SCONTRINO + MONETA)</td><td colspan='1'  align='right'>$resto_totale</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>TOTALE VENDUTO</td><td colspan='1'  align='right'>$totale_venduto</td></tr>";
			$bodyemail .= "<tr><td colspan='1'>Data AZZERAMENTO</td><td colspan='1'  align='right'>$azzeramento</td></tr>";
			$bodyemail .= "</table>";

			$bodyemail .= "<table align='center' style='border: 1px solid #CCCCCC;'>";
			$bodyemail .= "<tr bgcolor='#CCCCCC'><td colspan='3' align='center'>CONTATORE MOTORI</td></tr>";
			$bodyemail .= "<tr><td>Erogatori</td><td>Prodotti</td><td>Incasso</td></tr>";
			$bodyemail .= $body_contabilita_motori;
			$bodyemail .= "</table>";

      		$footeremail = "<table align='center' style='border: 1px solid #CCCCCC;'>
							<tr bgcolor='#CCCCCC'>
           					<td  align='center' colspan='2'>
							<font style='font-family:verdana; font-size:10pt; color:#1e5f8e; border-top: 1px solid #CCCCCC;'>
      						- MICROHARD - VENDING PROJECTS </td>
      						</tr></table></body></html>";
      						
      		$templateemail = $headeremail.$bodyemail.$footeremail;
	
     // classe per inviare email
   
   require_once $config['PHPMAILER_PATH'] . 'class.phpmailer.php';
   
    	$mail = new PHPMailer(true);
    	// allungo il tempo di post
        set_time_limit(3600);
        
       
        	
        try {
      		// allungo il tempo di post
        	set_time_limit(30); 
        		# $destinatario = $destinatari[$conta];
        		
    	     // 'Email inviata correttamente';
            $mail->IsSMTP(); // set mailer to use SMTP
			$mail->SMTPAuth   = true;
			$mail->From = "gfasulo@awanet.it";
			$mail->FromName = "Invio dati da C.R.M.";
			$mail->Host = "smtp.awanet.it";  // specify main and backup server
			$mail->Port       = 25;                    // Porta SMTP
			$mail->Username   = "gfasulo@awanet.it"; // SMTP account username
			$mail->Password   = "L1nux_2009";        // SMTP account password
			
			
				$mail->AddAddress("fgianpiero@gmail.com", "CONTABILITA");   // name is optional
				$mail->AddAddress("lorenzo.dedonato@ximplia.it", "CONTABILITA");

				$mail->AddReplyTo("gfasulo@awanet.it", "");
				$mail->WordWrap = 50;    // set word wrap
		
			$mail->IsHTML(true);    // set email format to HTML
			$mail->Subject = "INVIO DATI CONTABILITA' ";
			$mail->Body = "$templateemail";
		    
        	
        	# }
        	$mail->Send();
            $risultato_invio = "INVIO EMAIL OK";
        	}
			catch (phpmailerException $e) 
			{
				
                $risultato_invio = "ERRORE INVIO EMAIL ".$e;
				
			}
               
                    
            