<!DOCTYPE html>

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="MICROHARD - GESTIONALE">
    <meta name="author" content="XIMPLIA">
    <meta name="keyword" content="">
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>MICROHARD | GESTIONALE</title>
   
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="css/examples.css" rel="stylesheet">
  
  </head>
  <body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
                <form name="login" id="login" method="post" action="invia_nuova_password.php" >
                   
                    <div class="card-group d-block d-md-flex row">
              
                    <div class="card col-md-7 p-4 mb-0">
                      <div class="card-body">
                        <h1>MICROHARD</h1>
                        <p class="text-medium-emphasis">Procedura RESET PASSWORD</p>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                            <svg class="icon">
                              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-closed"></use>
                            </svg>
                            </span>
                          <input class="form-control" value="" type="email" name="indirizzo_email" id="indirizzo_email" placeholder="Indirizzo E-mail" required>
                        </div>
                       
                        <div class="row">
                          <div class="col-6">
                            <button class="btn btn-primary px-4" type="submit" id="bottone_reset" >RICHIEDI RESET</button>
                          </div>
                        
                        </div>
                        <div class="row">
                          <div class="col-12 text-center">
                               Il tuo IP: 
                               <span id="client_ip"><?= getenv("REMOTE_ADDR"); ?></span>
                               <input type="hidden" name="ip_client"  value="<?= getenv("REMOTE_ADDR"); ?>">
                          </div>
                        </div>
                        
                      </div>
                    </div>
              
                        <div class="card col-md-5 text-white bg-primary">
                          <div class="card-body text-center">
                            <div>
                              <h2>RESET PASSWORD</h2>
                              <p>
                                  La procedura di reset password, prevede l'invio alla email indicata di una
                                  nuova password generata automaticamente.
                                  Si potrà poi modifcare la stess, entrando nel gestionale
                                  e cliccando sul menù Profilo in alto a destra della barra superiore.
                              </p>
                              <br />
                              
                            </div>
                             
                          </div>
                        </div>
                      </div>
                </form>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script  src="https://code.jquery.com/jquery-3.6.1.min.js"  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    
      
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
</script>

  </body>
</html>



