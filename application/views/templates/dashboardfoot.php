<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8f37dd1c37.js" crossorigin="anonymous"></script>
<script>

  $(document).ready(function() {
        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });
      });
  
  $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

    <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3):?>
      var dropdown = document.getElementsByClassName("kelas");

      dropdown[0].addEventListener("click", function() {
      var dropdownContent = document.getElementById('dropdown-container');
      if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
      } else {
      sidebar.classList.toggle("open",true);
      menuBtnChange();
      dropdownContent.style.display = "block";
      }
      });
    <?php endif;?>

    <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3 || $this->session->userdata('role_id') == 5):?>
    var dropdownMonev = document.getElementsByClassName("monev-side");
    var dropdownTenant = document.getElementsByClassName("tenant");

    dropdownMonev[0].addEventListener("click", function() {
    var dropdownMonevContent = document.getElementById('dropdown-container-2');
    if (dropdownMonevContent.style.display === "block") {
    dropdownMonevContent.style.display = "none";
    } else {
    sidebar.classList.toggle("open",true);
    menuBtnChange();
    dropdownMonevContent.style.display = "block";
    }
    });

    dropdownTenant[0].addEventListener("click", function() {
    var dropdownTenantContent = document.getElementById('dropdown-container-3');
    if (dropdownTenantContent.style.display === "block") {
    dropdownTenantContent.style.display = "none";
    } else {
    sidebar.classList.toggle("open",true);
    menuBtnChange();
    dropdownTenantContent.style.display = "block";
    }
    });
    <?php endif;?>


  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     var dropdownContent = document.getElementById('dropdown-container');
     var dropdownMonevContent = document.getElementById('dropdown-container-2');
     var dropdownTenantContent = document.getElementById('dropdown-container-3');
     if (dropdownContent.style.display === "block" || dropdownMonevContent.style.display === "block" || dropdownTenantContent.style.display === "block") {
        dropdownContent.style.display = "none";
        dropdownMonevContent.style.display="none";
        dropdownTenantContent.style.display = "none";
      }
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }

  </script>
</body>
</html>
