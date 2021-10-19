 
<?php  


  if(isset($_SESSION['idUser']))
  {
      $result=get_user_by_id($_SESSION['idUser']);
  }

    $photo="";

if(isset($_POST['p_btn']))
{

  $photo=$_FILES['userfile']['name'];

  $upload="assets/Images/PP/".$photo;
  
  move_uploaded_file($_FILES['userfile']['tmp_name'], $upload);
  
  add_profil($_SESSION['idUser'], $upload, $_SESSION['nom']);

                echo "<script>
                           window.location = './index.php?module=utilisateur&action=profil&id='".$_SESSION['idUser'].";
                      </script>"; 
}
?>
</head>
<body>
  <?= $content ?>
<div class="container-general container-projet">
    <div class="M_wrapper-menu ">
        <?php include  "include/menu.php" ?>
    </div>
    <div class="container-content container-contenu">
       <div class="p_box1">
          
          <div class="p_grand"> 
              <div class="p_box1a">
                  <div class="p_file">
                      <div class="p_box1a1">  
                          <?php show_user($_SESSION['idUser']); ?>
                      </div> 
                      <div class="p_box1a1_info">
                        
                      </div>

                    <form method="post" enctype="multipart/form-data" action=" "  >
                        
                        <label for="p_file2" class="p_file2" title="modifier" >
                            <i class="fa fa-camera" id="p_icone"></i>
                        </label>
                        <input hidden name= "MAX_FILE_SIZE" value= "20000000">
                        <input name="userfile" type="file" hidden="" class="Me_file" id="p_file2" onchange="update_pp()" accept="image/png,image/jpeg,image/tiff,image/svg,image/ico,image/pjp,image/gif" />
                        <button name="p_btn" class="p_btn">Modifier</button>
                       
                    </form>             

                   </div>   
                    <div class="p_box11"> 
                        Votre profil
                    </div>
             <div class="p_box1a2">
                 <div class="p_box1a2a">
                      <label>Nom*</label>
                      <input type="text" name="" value="<?php  echo $result['Nom_utilisateur'];  ?>" disabled>
                      <label>Prenom**</label>
                     <input type="text" name="" value="<?php  echo $result['Prenom_utilisateur'];  ?>" disabled>
                     <label>Login***</label>
                     <input type="text" name="" value="<?php  echo $result['Login'];  ?>" disabled>
                     <label>Mot de passe****</label>
                     <input type="password" name="" value="<?php  echo $result['MDP'];  ?>" disabled>
                 </div>
                 <div class="p_box1a2b">
                  <label>Email*****</label>
                  <input type="email" name="" value="<?php  echo $result['mail'];  ?>" disabled>
                  
                     <label>Fonction******</label>
                  <input type="text" name="" value="<?php  $query2=  get_user_by_type_user($result['Role']);  echo $query2['nom_type_user'];  ?>" disabled>
                  <label>Localite*******</label>
                  <input type="text" name="" value="<?php  echo $result['localite'];  ?>" disabled>
                  <label>Telephone*********</label>
                  <input type="number" name="" value="<?php  echo $result['telephone'];  ?>" disabled>
                   
                 </div>
             </div>
             
           </div>
         </div>
       </div> 
    </div>       
  </div>     
	 <script type="text/javascript">
          $(document).ready(function() 
          {
              function readURL (input) 
              {
                  if (input.files && input.files[0]) 
                  {
                      var reader = new FileReader();

                      reader.onload = function (e) 
                      {
                          $('.avatar').attr('src', e.target.result);
                      }
              
                      reader.readAsDataURL(input.files[0]);
                  }
              }
              

              $(".file-upload").on('change', function()
              {
                  readURL(this);
              });

              $('.p_btn').click(function()
              {

                  var result=true;
                  var photo =$('.Me_file').val()=="";

                  if(photo)
                  {

                    $('.P_error').css('display','block').hide(4000);
                      result=false;

                  }
                  else
                  {
                    result=true;
                  }
                  return result;

              });
              
      });

          //on crée deux variables contenant les types qu'on passera en parametre plutard en fontion de l'envoyeur de fichier choisi


    function validFileType(file) 
    {
      var type = [
                        'image/jpeg',
                        'image/jpg',
                        'image/png',
                        'image/svg',
                        'image/tiff',
                        'image/ico',
                        'image/pjp',
                        'image/gif',
                      ];
      for(var i = 0; i < type.length; i++)
       {
        if(file.type === type[i])
        {
          return true;
        }
       }

      return false;
    }

    function update_pp() 
    {
      var input = document.querySelector('#p_file2');
      var preview = document.querySelector('.p_box1a1_info');
      
      while(preview.firstChild) 
        {
          preview.removeChild(preview.firstChild);
        }
     
      var curFiles = input.files;
      if(curFiles.length !== 0) 
      {
        for(var i = 0; i < curFiles.length; i++)
        {   

          if(validFileType(curFiles[i])) 
          {
              preview.style.display='block';
              preview.innerHTML='';
              document.querySelector('.p_box1a1').style.opacity='0';
              document.querySelector('.p_btn').style.opacity='1';
              var image = document.createElement('img');
              image.src = window.URL.createObjectURL(curFiles[i]);
              preview.appendChild(image);

                  
          }
        }
      }
      else
      {
        preview.style.display='none';
        preview.innerHTML='';
        document.querySelector('.p_box1a1').style.opacity='1';
        document.querySelector('.p_btn').style.opacity='0';
      }
    }
   </script>
 
			