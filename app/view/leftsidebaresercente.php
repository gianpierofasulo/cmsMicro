<!-- ESERCENTE -->
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
           <div class="col-12 text-center">
                <img src="img/microhard.png" alt="MICROHARD" width="190px">
          </div>
         
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="?page=layout">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard - <?= $_SESSION['utente_ruolo']; ?>
            </a>
        </li>
        
        
        <li class="nav-group <?php echo ($page == 'catalogo_esercente' || 
                                         $page == 'modifica_catalogo_esercente' ? 'show' : ''); ?>"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cart"></use>
            </svg> Catalogo</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'catalogo_esercente' ? 'active' : ''); ?>" href="index.php?page=catalogo_esercente"><span class="nav-icon"></span> Inserisci</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'modifica_catalogo_esercente' ? 'active' : ''); ?>" href="index.php?page=modifica_catalogo_esercente"><span class="nav-icon"></span> Modifica</a></li>
<!--            <li class="nav-item"><a class="nav-link <?php echo ($page == 'catalogo_step_programmi_washing' ? 'active' : ''); ?>" href="index.php?page=catalogo_step_programmi_washing"><span class="nav-icon"></span> Step Programmi Washing</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'catalogo_programmi_washing' ? 'active' : ''); ?>" href="index.php?page=catalogo_programmi_washing"><span class="nav-icon"></span> Programmi Washing</a></li>-->
          </ul>
        </li>
        
        <li class="nav-group <?php echo (  $page == 'macchine_vetrine_digitali' || $page == 'esercenti_macchine_stampe' || $page == 'esercenti_macchine_vetrine' || $page == 'esercenti_macchine_canali' || $page == 'esercenti_macchine_configurazione' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'macchine_vetrine_digitali' || $page == 'esercenti_macchine_stampe' || $page == 'esercenti_macchine_vetrine' || $page == 'esercenti_macchine_canali' || $page == 'esercenti_macchine_configurazione' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-usb"></use>
            </svg> Macchine</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'esercenti_macchine_vetrine' ? 'active' : ''); ?>" href="index.php?page=esercenti_macchine_vetrine"><span class="nav-icon"></span> Vetrine</a></li>
            </ul>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'esercenti_macchine_canali' ? 'active' : ''); ?>" href="index.php?page=esercenti_macchine_canali"><span class="nav-icon"></span> Canali</a></li>
            </ul>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'esercenti_macchine_configurazione' ? 'active' : ''); ?>" href="index.php?page=esercenti_macchine_configurazione"><span class="nav-icon"></span> Configurazione</a></li>
            </ul>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'esercenti_macchine_stampe' ? 'active' : ''); ?>" href="index.php?page=esercenti_macchine_stampe"><span class="nav-icon"></span> Stampe</a></li>
            </ul>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'macchine_vetrine_digitali' ? 'active' : ''); ?>" href="index.php?page=macchine_vetrine_digitali"><span class="nav-icon"></span> Vetrine digitali</a></li>
            </ul>
        </li>

        <li class="nav-group <?php echo ( $page == 'esercenti_macchine_media' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'esercenti_macchine_media' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg> Media</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'esercenti_macchine_media' ? 'active' : ''); ?>" href="index.php?page=esercenti_macchine_media"><span class="nav-icon"></span> Gestione</a></li>
            </ul>
           
        </li>

        <li class="nav-group <?php echo ( $page == 'gestione_banner' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'gestione_banner' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-image-plus"></use>
            </svg> Banner</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'gestione_banner' ? 'active' : ''); ?>" href="index.php?page=gestione_banner"><span class="nav-icon"></span> Gestione</a></li>
            </ul>
           
        </li>

        <li class="nav-group <?php echo ( $page == 'gestione_rete' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'gestione_rete' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lan"></use>
            </svg> Rete</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'gestione_rete' ? 'active' : ''); ?>" href="index.php?page=gestione_rete"><span class="nav-icon"></span> Gestione</a></li>
            </ul>
           
        </li>

        <li class="nav-group <?php echo ( $page == 'contabilita' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'contabilita' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-euro"></use>
            </svg> Contabilità</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'contabilita' ? 'active' : ''); ?>" href="index.php?page=contabilita"><span class="nav-icon"></span> Visualizza</a></li>
            </ul>
           
        </li>

        <li class="nav-group <?php echo ( $page == 'tickets' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'tickets' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
            </svg> Tickets</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'tickets' ? 'active' : ''); ?>" href="index.php?page=tickets"><span class="nav-icon"></span> Gestione</a></li>
            </ul>
           
        </li>

        <li class="nav-group <?php echo ( $page == 'logs' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'logs' ? 'true' : 'logs'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
            </svg> Logs</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'logs' ? 'active' : ''); ?>" href="index.php?page=logs"><span class="nav-icon"></span> Visualizza</a></li>
            </ul>
           
        </li>

        <li class="nav-group <?php echo ( $page == 'recovery' ? 'show' : ''); ?>
                            aria-expanded="<?php echo (  $page == 'recovery' ? 'true' : 'recovery'); ?>" ">
            <a class="nav-link nav-group-toggle" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-save"></use>
            </svg> Recovery</a>

            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link <?php echo ($page == 'recovery' ? 'active' : ''); ?>" href="index.php?page=recovery"><span class="nav-icon"></span> JSON</a></li>
            </ul>
           
        </li>
        
        
      
   
     
        <li class="nav-item mt-auto"><a class="nav-link" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
            </svg> Docs</a></li>
     
      </ul>
      <!--<button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>-->
    </div>