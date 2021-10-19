


<script type="text/javascript" src="./assets/js/notification.js"></script>
  <title>Notification</title>
</head>
<body>
      <?= $content ?>

    <div class="ME_box">
          <?php   include "include/menu.php" ?>
    </div>
    <div class="ME_block2"> <!--contener utilisé pour la mise en page générale dans les messages et les événements...!-->
        <h2 id="N_notif_big_title">NOTIFICATIONS</h2>
        <div class="N_notification">
              <div class="N_notification_type_container">
                <?php Get_notification($bdd,$_SESSION['idUser'],2); ?>
              </div>
          </div>
    </div>

    
           